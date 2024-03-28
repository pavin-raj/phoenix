<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index($id, Request $request)
    {
        
        $assignees = User::whereRaw('role_id = 3 or role_id = 4')->paginate(9);

        if($request->has('search'))
        $assignees = User::search($request->search)->whereIn('role_id', [3,4])->paginate(9);

        return view('tasks.assignees.request_help', ['task_id' => $id, 'assignees' => $assignees]);
    }
    
}
