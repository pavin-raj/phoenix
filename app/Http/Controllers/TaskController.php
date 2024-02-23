<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stevebauman\Location\Facades\Location;

class TaskController extends Controller
{
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
        $task = Task::create($data);

        $array = isset($array) ? array_merge($array, [$task->id]) : [$task->id];
        json_encode($array);

        // Inseritng task contact info to Task_Contact table
        $data=$request->validate([
            'phone' => 'digits: 10',
            'email' => 'email:rfc,dns',
        ]);
        $data['task_id'] = $task->id;
        $taskContact = TaskContact::create($data);

        return redirect('/');
    }
}
