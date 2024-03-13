<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;


use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

   
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    
    public function store(StoreProjectRequest $request)
    {
        $validatedProjectData = $request->validated();

        
        $coverImgPath = null;

       
        if (isset($validatedProjectData['cover_img'])) {
            
            $coverImgPath = Storage::disk('public')->put('images', $validatedProjectData['cover_img']);
        }

        $validatedProjectData['slug'] = Str::slug($validatedProjectData['title']);
        $validatedProjectData['cover_img'] = $coverImgPath;

        $project = Project::create($validatedProjectData);

        
        if (isset($validatedProjectData['technologies'])) {

           
            foreach ($validatedProjectData['technologies'] as $technologyId) {

               
                $project->technologies()->attach($technologyId);
            }
        }

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('admin.projects.show', compact('project'));
    }

   
    public function edit(string $slug)
    {
        $technologies = Technology::all();

        $types = Type::all();

        $project = Project::where('slug', $slug)->firstOrFail();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    
    public function update(UpdateProjectRequest $request, string $slug)
    {
        $validatedProjectData = $request->validated();

        $project = Project::where('slug', $slug)->firstOrFail();

        
        $coverImgPath = $project->cover_img;

        
        if (isset($validatedProjectData['cover_img'])) {
            
            if ($project->cover_img != null) {
                
                Storage::disk('public')->delete($project->cover_img);
            }

            
            $coverImgPath = Storage::disk('public')->put('images', $validatedProjectData['cover_img']);

        } 
        
        else if(isset($validatedProjectData['delete_cover_img'])) {

            
            Storage::disk('public')->delete($project->cover_img);

            
            $coverImgPath = null;
        }
        
        $validatedProjectData['slug'] = Str::slug($validatedProjectData['title']);
        $validatedProjectData['cover_img'] = $coverImgPath;

        $project->update($validatedProjectData);

        if (isset($validatedProjectData['technologies'])) {
            $project->technologies()->sync($validatedProjectData['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show',['project'=>$project->slug]);
    }

    
    public function destroy(string $slug)
    {   
        $project = Project::where('slug', $slug)->firstOrFail();

        
        if ($project->cover_img != null) {
            
            Storage::disk('public')->delete($project->cover_img);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}