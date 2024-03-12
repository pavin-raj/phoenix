<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Assignee;
use App\Models\TaskContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class TaskController extends Controller
{

    // Show all tasks/requests
    public function index(){
        if(Auth::guest() || Auth::user()->hasRole('citizen')){
            $taskIds = getTaskCookie();
            $tasks = Task::whereIn('id', $taskIds)->get();
        }
        else if (Auth::user()->hasRole('admin')){
            $tasks = Task::all();
        }
        else if ((Auth::user()->hasRole('emergency responder')) || (Auth::user()->hasRole('volunteer'))){

           $tasks = Task::with('assignees')->whereHas('assignees', function ($query) {
                $query->where('user_id', Auth::user()->id);
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
        $userIP = generateRandomIPAddress();
        $location = Location::get($userIP);

        // Inserting task data to Tasks table
        $data=$request->validate([
            'description'=>'required'
        ]);
        $data['description'] = $data['description'] . "\n\nContact Info is\n" . $request->contact;
        $data['user_id']=auth()->id();
        $data['latitude'] = $location->latitude;
        $data['longitude'] = $location->longitude;
        $data['city'] = $location->cityName;
        $data['state'] =  $location->regionName;
        $task = Task::create($data);    
    
        // Set the cookie with appropriate values
        storeTaskCookie($task->id);

        
        // Inseritng task contact info to Task_Contact table
        $data=$request->validate([
            'phone' => 'nullable|digits: 10',
            'email' => 'nullable|email:rfc,dns',
        ]);
        $data['task_id'] = $task->id;
        $taskContact = TaskContact::create($data);

        return redirect('/');
    }


    public function show($id) {
        $task = Task::find($id);
        $priority = ['High', 'Moderate', 'Low', 'Very Low'];
        $status = ['Open', 'On Hold', 'Closed'];
        return view('tasks.show', ['task'=>$task, 'priority'=>$priority, 'status'=> $status]);
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

    public function assignees($id){
        $userId = Assignee::select('user_id')->where('task_id', $id)->get();
        $users=[];

        foreach ($userId as $uid){
            $users = array_merge($users, [User::find($uid)->toArray()]);
        }

        return view('tasks.assignees', ['task_id' => $id, 'users' => $users]);
    }
}


