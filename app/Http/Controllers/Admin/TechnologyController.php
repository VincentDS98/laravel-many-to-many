<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Technologies\StoreTechnologyRequest;
use App\Http\Requests\Technologies\UpdateTechnologyRequest;


use App\Models\Technology;


use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }

    
    public function create()
    {
        return view('admin.technologies.create');
    }

   
    public function store(StoreTechnologyRequest $request)
    {
        $technologyDataRequest = $request->validated();

        $technologyDataRequest['slug'] = Str::slug($technologyDataRequest['title']);

        $technology = Technology::create($technologyDataRequest);

        return redirect()->route('admin.technologies.show',['technology'=>$technology->slug]);

    }

    
    public function show(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();

        return view('admin.technologies.show', compact('technology'));
    }

    
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    
    public function update(UpdateTechnologyRequest $request, string $slug)
    {
        $technologyDataRequest = $request->validated();

        $technology = Technology::where('slug', $slug)->firstOrFail();

        $technologyDataRequest['slug'] = Str::slug($technologyDataRequest['title']);

        $technology->update($technologyDataRequest);

        return redirect()->route('admin.technologies.show',['technology'=>$technology->slug]);

    }

   
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index');
    }
}