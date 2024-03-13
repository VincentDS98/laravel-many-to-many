<?php

namespace App\Http\Controllers;


use App\Models\Project;
use App\Models\Type;


use Illuminate\Http\Request;


use Illuminate\Support\Str;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = Project::all();
        
        return view("projects.index", compact("projects"));
    }


    
    public function show(string $slug)
    {

        $types = Type::all();

        $project = Project::where('slug', $slug)->firstOrFail();

        return view("projects.show", compact("project", 'types'));
    }

}