<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Type;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\EditTypeRequest;


use Illuminate\Support\Str;



class TypeController extends Controller
{
   
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    
    public function create()
    {
        return view('admin.types.create');
    }

   
    public function store(StoreTypeRequest $request)
    {
        $validatedTypeData = $request->validated();   

        $validatedTypeData['slug'] = Str::slug($validatedTypeData['title']);

        $type = Type::create($validatedTypeData);

        return redirect()->route('admin.types.show',['type'=>$type->slug]);
    }

    
    public function show(string $slug)
    {

        $type = Type::where('slug', $slug)->firstOrFail();

        return view('admin.types.show', compact('type'));
    }

    
    public function edit(Type $type)
    {
       
        return view('admin.types.edit', compact('type'));
    }

    
    public function update(EditTypeRequest $request, string $slug)
    {
        $validatedTypeRequest = $request->validated();   

        $type = Type::where('slug', $slug)->firstOrFail();

        $validatedTypeRequest['slug'] = Str::slug($validatedTypeRequest['title']);

        $type->update($validatedTypeRequest);

        return redirect()->route('admin.types.show',['type'=>$type->slug]);


    }

   
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index');
    }
}