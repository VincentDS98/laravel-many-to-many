<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Technology;


use Illuminate\Support\Str;


class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::all();
        
        return view("technologies.index", compact("technologies"));
    }


    public function show(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();

        return view("technologies.show", compact("technology"));
    }
}