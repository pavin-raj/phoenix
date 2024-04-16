<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assignee;
use Illuminate\Http\Request;
use App\Models\VolunteerSkill;
use App\Events\UserAuthenticated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => 'required | regex:/^[a-zA-Z ]+$/',
            'email' => 'required | email:rfc,dns | unique:users,email',
            'password' => [
                'required', 
                'confirmed',
                Password::min(8)->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()]
        ]);

        $formFields['role_id'] = $request->user_type;
        
        // Encrypt Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login User
        auth()->login($user);
        UserAuthenticated::dispatch();
        return redirect('/')->with('message', 'User created successfully');

    }


    public function login(){
        return view('users.login');
    }


    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => 'required | email:rfc,dns',
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            $user = auth()->user();
            UserAuthenticated::dispatch();
            return redirect('/')->with('message', 'You are logged in');
        }

        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }

    
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out successfully');
    }


    public function show($id){
        $task_id = Session::get('task_id');
        $user = User::find($id);
        $volunteer_skills = User::find($id)->volunteer_skills()->get();

        $skills = ['First Aid Skills', 'CPR', 'IT', 'Data Recovery', 'Construction worker', 'Carpentry', 
        'Electrician', 'Plumbing', 'Forklifts', 'Generator Operator', 'Fundraising', 'Damage Assessment', 
        'Needs Identification', 'Data Collection', 'Data Analysis', 'Inventory Management', 'Warehouse Operations', 
        'Transportation', 'Driving', 'Medical Professional', 'Doctor', 'Nurse', 'Mental health professional', 
        'Counselor', 'Therapist', 'Public Health Trainer', 'Multilingual', 'English langugae', 'Malayalam language', 
        'Tamil language', 'Arabic language', 'Telugu language', 'Tulu language', 'Security and crowd control'];


        // If the profile page is accessed from assignable users page in tasks
        if( $task_id != null)
            $request_status = Assignee::select('is_requested','is_accepted', 'is_rejected')
            ->where('task_id', $task_id)
            ->where('user_id', $id)
            ->first();
        else
            $request_status = ['is_requested' => 0, 'is_accepted' => 0, 'is_rejected' => 0];

        return view('users.show', 
        ['user'=> $user, 
        'volunteer_skills' => $volunteer_skills , 
        'skills'=> $skills, 
        'request_status' => $request_status]);
    }

    public function update($id, Request $request){
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/',  
            'image'=>'nullable|mimes:jpg,jpeg,png,webp',
            'email' => $request->email === $user->email ? 'required|email' : 'required|email|unique:users',
        ]);

        if($request->has('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $path = 'uploads/profile/';
            $filename = time(). '.' . $extension;
            $file->move($path, $filename);
        }
        $data['image'] = $path.$filename;


        VolunteerSkill::where('user_id', $id)->delete();
        foreach($request->skills as $skill){
            VolunteerSkill::create([
                'user_id' => $id,
                'skill' => $skill
            ]);
        }

        User::find($id)->update($data);

        return redirect()->back();
    }
}
