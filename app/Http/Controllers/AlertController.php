<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlertController extends Controller
{
    public function index(){
        $alerts = Alert::orderBy('created_at')->get();
        return view('alerts.index', ['alerts'=>$alerts]);
    }

    public function create(){
        return view('alerts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'alert_type' => 'required|string',
            'headline' => 'nullable|string',
            'description' => 'required|string',
            'issuing_agency' => 'required|string',
            'location' => 'nullable|string',
            'severity_level' => 'required|string',
            'response_instruction' => 'nullable|string',
        ]);

        $alert = Alert::create($validatedData);

        return redirect()->route('alerts.index')->with('success', 'Alert created successfully!');
    }

    public function show($id){
        $alert = Alert::find($id);
        return view('alerts.show', ['alert'=>$alert]);
    }
}
