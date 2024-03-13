<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Type;


use Illuminate\Support\Str;

class TypeController extends Controller
{
    
    public function index()
    {
        $types = Type::all();
        
        return view("types.index", compact("types"));
    }


    
    public function show(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();

        return view("types.show", compact("type"));
    }

}