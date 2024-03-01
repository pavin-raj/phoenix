<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

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

        // Checks if user type is provided by user, else made a citizen
        $formFields['role_id'] = $request->filled('user_type') ? $request->user_type : 5;
        // Encrypt Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login User
        auth()->login($user);

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


    
}
