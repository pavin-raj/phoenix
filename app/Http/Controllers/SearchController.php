<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assignee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function index($id, Request $request)
    {
        
        $assignees = User::whereIn('role_id', [3, 4])
        ->whereDoesntHave('assignees', function ($query) use ($id)
        {
            $query->where('task_id', $id)->where('is_accepted', true);
        })->paginate(9);
        

        if($request->has('search'))
        {
            $users = User::search($request->search)->whereIn('role_id', [3,4])->get();

            $assigned_users = Assignee::where('task_id', $id)
            ->where(function ($query) {
                $query->where('is_accepted', 1)
                ->orWhere('is_rejected', 1);
            })
            ->get();

            $assignees = collect();
            foreach($users as $user)
            {
                // Flag to check if any user in $users is assigned to this task
                $found = false;
                foreach($assigned_users as $assigned_user)
                {
                    if($user->id == $assigned_user->user_id)
                    {
                        // True only if they have been assigneed to this task
                        $found = true;
                        break;
                    }
                }
                if (!$found)
                    // Executes only if user is not assigned
                    $assignees->push($user);
            }
            $assignees = $assignees->paginate(9);
        }

        return view('tasks.assignees.assignable_users', ['task_id' => $id, 'assignees' => $assignees]);
    }
    
}
