<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Assignee;
use App\Models\TaskContact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class TaskController extends Controller
{

    public function index(){
        if(Auth::guest()){
            $taskTokens = getTaskCookie();
            $tasks = Task::whereIn('task_token', $taskTokens)->latest()->get();
        }
        else if (Auth::user()->hasRole('citizen')) {
            $tasks = Task::where('user_id', Auth::user()->id)->latest()->get();
        }
        else if (Auth::user()->hasRole('admin')){
            $tasks = Task::all();
        }
        else if (Auth::user()->hasRole('emergency responder')){

           $tasks = Task::with('assignees')->whereHas('assignees', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->get();
        }
        else if(Auth::user()->hasRole('volunteer'))
        {
            $tasks = Task::with('assignees')->whereHas('assignees', function ($query) {
                $query->where('user_id', Auth::user()->id)->where('is_accepted', false);
            })->get();
        }
        return view('tasks.index', ['tasks' => $tasks]);
    }


    // Report Danger
    public function create(){
        return view('tasks.create');
    }



    public function store(Request $request){
        // To get Users Ip
        // $userIP = $request->ip();

        // Generate Random IP Address and get its location
        // $userIP = generateRandomIPAddress();
        // $location = Location::get($userIP);
        
        $location = Http::withUrlParameters([
            'endpoint' => 'https://api.geoapify.com/v1/geocode/reverse',
            'lat' => $request->latitude,
            'lon' => $request->longitude,
            'apiKey' =>  Config::get('services.geoapify.key'),
            ])->get('{+endpoint}?lat={lat}&lon={lon}&apiKey={apiKey}');


        $location = $location['features'][0]['properties'];
        

        // Inserting task data to Tasks table
        $request->validate([
            'description'=>'required',
            'contact' => 'required_without_all:phone,email',
            'phone' => ['required_without_all:contact,email','nullable','digits: 10'],
            'email' => ['required_without_all:contact,phone','nullable','email:rfc,dns'],
        ]);
        $task_data['description'] = $request->description . "\n\nContact Info is\n" . $request->contact;
        $task_data['user_id']=auth()->id();
        $task_data['latitude'] = $request->latitude;
        $task_data['longitude'] = $request->longitude;
        $task_data['city'] = $location['city'];
        $task_data['state'] =  $location['state'];
        $task_data['task_token'] = Str::random(32) ."-". Str::uuid() ."-". Str::random(32);
        $task = Task::create($task_data);    
    

        // Set the cookie with appropriate values if user not logged in
        if(!Auth::check())
        storeTaskCookie($task->task_token);

        
        // Inseritng task contact info to Task_Contact table
        $contact_data['phone'] = $request->phone;
        $contact_data['email'] = $request->email;
        $contact_data['task_id'] = $task->id;
        $taskContact = TaskContact::create($contact_data);

        return redirect('/tasks/index');
    }


    public function show($id) {
        $task = Task::find($id);
        $priority = ['High', 'Moderate', 'Low', 'Very Low'];
        $status = ['Open', 'On Hold', 'Closed'];

        $request_status = Assignee::select('is_requested','is_accepted', 'is_rejected')
        ->where('task_id', $id)
        ->where('user_id', auth()->id())
        ->first();

        // Store task_id in session for later using while requesting/accepting/rejecting task.
        Session::put('task_id', $id);
       
        return view('tasks.show', ['task'=>$task, 'priority'=>$priority, 'status'=> $status, 'request_status'=>$request_status]);
    }


    public function update(Request $request, $id){
        // Get task matching id
        $task = Task::find($id);

        // Updating task data in Tasks table
        $data = $request->validate([
            'description'=>'required'
        ]);
        $task->description = $data['description'];
        $task->city = $request->city;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->state =  $request->state;
        
        $task->update();

        // Get task contact matching taskid
        $task_contact = TaskContact::where('task_id', $task->id)->first();
        

        // Updating task contact info in Task_Contact table
        $data=$request->validate([
            'phone' => 'nullable|digits: 10',
            'email' => 'nullable|email:rfc,dns',
        ]);
        $task_contact->phone = $data['phone'];
        $task_contact->email = $data['email'];
        $task_contact->secondary_phone = $request->secondary_phone;
        $task_contact->secondary_email = $request->secondary_email;
        $task_contact->address = $request->address;
        $task_contact->update();

        return redirect()->back();

    }


    public function destroy($id) {
        $task = Task::find($id);
        $task->delete();
        return redirect('tasks/index');
    }



    public function messages($id){
        $messages = Task::find($id)->messages()->latest()->get();
        return view('tasks.messages', ['task_id' => $id,'messages' => $messages]);
    }


    public function storeMessage($id, Request $request){
        $request->validate([
            'body'=>'required|string',
            'file'=>'nullable|mimes:jpg,jpeg,png,webp'
        ]);

        if($request->has('file')){
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            $path = 'uploads/messages/';
            $filename = time(). '.' . $extension;
            $file->move($path, $filename);
        }

        Message::create([
            'body' => $request->body,
            'file' => $path.$filename,
            'task_id' => $id,
            'user_id' => auth()->id()
        ]);

        return redirect()->back();
    }


    public function assigned_tasks() {
        $assignedTaskIds = DB::table('assignees')->select('task_id');
        $assigned_tasks = DB::table('tasks')
  ->whereIn('id', $assignedTaskIds)
  ->get();
         return view('tasks.assigned_tasks', ['assigned_tasks' => $assigned_tasks]);
    }

    public function unassigned_tasks() {
        $assignedTaskIds = DB::table('assignees')->select('task_id');
        $unassigned_tasks = DB::table('tasks')
  ->whereNotIn('id', $assignedTaskIds)
  ->get();
         return view('tasks.unassigned_tasks', ['unassigned_tasks' => $unassigned_tasks]);
    }

    
    public function accepted_tasks(){
        $accepted_tasks = Task::with('assignees')->whereHas('assignees', function ($query) {
                $query->where('user_id', Auth::user()->id)->where('is_accepted', true);
            })->get();
        return view('tasks.accepted_tasks', ['accepted_tasks' => $accepted_tasks]);
    }

}


