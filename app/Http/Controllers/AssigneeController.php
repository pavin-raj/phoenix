<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assignee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AssigneeController extends Controller
{

    public function index($id)
    {
        $userId = Assignee::select('user_id')->where('task_id', $id)->where('is_accepted', true)->get();
        $assignees=[];

        foreach ($userId as $uid){
            $assignees = array_merge($assignees, [User::find($uid)->toArray()]);
        }

        if((Route::current()->uri) == "tasks/show/{id}/assignees" )
        return view('tasks.assignees.index', ['task_id' => $id, 'assignees' => $assignees]);

        else if((Route::current()->uri) == "tasks/show/{id}/emergency_responders" )
        return view('tasks.assignees.emergency_responders', ['task_id' => $id, 'assignees' => $assignees]);

        else if((Route::current()->uri) == "tasks/show/{id}/volunteers" )
        return view('tasks.assignees.volunteers', ['task_id' => $id, 'assignees' => $assignees]);
    }


    public function store($user_id)
    {
        $task_id = Session::get('task_id');
        $assign_task = [
            'task_id' => $task_id,
            'user_id' => $user_id,
            'is_requested' => 1,
            'is_accepted' => User::find($user_id)->hasRole('emergency responder') ? 1 : 0
        ];

        Assignee::create($assign_task);

        $request_status = Assignee::select('is_requested','is_accepted', 'is_rejected')
        ->where('task_id', $task_id)
        ->where('user_id', $user_id)
        ->first();

        return redirect()->route('assignees', $task_id);
    }


    public function update(Request $request) {

        if($request->request_status == 'accept') {
            $approved = 1;
            $rejected = 0;
        }
        else {
            $approved = 0;
            $rejected = 1;
        }
        $task_id = Session::get('task_id');

        $assignee = Assignee::where('task_id', $task_id)
        ->where('user_id', auth()->id());

        $assignee->update([
            'is_accepted' => $approved,
            'is_rejected' => $rejected
        ]);
        
        return redirect('/tasks/accepted');
    }
}
