<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
    }

    public function show($project)
    {
        if ($project === 'simple_shell') {
            return view('projects.simple_shell');
        } elseif ($project === 'vanilla_auth') {
            return view('projects.vanilla_auth');
        } elseif ($project === 'airbnb_clone') {
            return view('projects.airbnb_clone');
        } elseif ($project === 'easypay') {
            return view('projects.easypay');
        } else {
            abort(404);
        }

        // Pass the data to the view
        return view("projects.$project");
    }
}
