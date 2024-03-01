<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stevebauman\Location\Facades\Location;

class TaskController extends Controller
{

    // Show all tasks/requests
    public function index(){
        $taskIds = getTaskCookie();
        $tasks = Task::whereIn('id', $taskIds)->get();
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


}
