@extends('layouts.app')

@section('page-title', $type->title)

@section('main-content')
    <section id="type-show">
        <div class="row g-0">
            <div class="col d-flex justify-content-center">
                <div class="my-card">
                    <div class="my-card-body">
                        <h1 class="text-center mb-5">
                            {{ $type->title }}
                        </h1>

                        <div class="text-center">

                            <ul>

                               
                                @foreach ($type->projects as $project)
                                    <li class="text-start">
                                        <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}" class="mb-3"> 
                                            {{ $project->title }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>

                        </div>
                        <div class="edit-buttons-container d-flex flex-column align-items-end">
                            
                            <a href="{{ route('admin.types.edit', ['type' => $type->id]) }}" class="edit-button mb-2">
                                <i class="fa-solid fa-pencil"></i>
                            </a>

                            <button class="erase-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $type->slug }}">
                                <i class="fa-solid fa-eraser"></i>
                            </button>
    

                            <div class="modal fade" id="staticBackdrop-{{ $type->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                Eliminazione Linguaggio
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuto di voler eliminare: <b> {{ $type->title }} </b> ?
                                        </div>
                                        <div class="modal-footer">
    
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    
                                           
                                            <form 
                                            action="{{ route('admin.types.destroy', ['type' => $type->id]) }}" 
                                            method="POST">
                                         
                                            @csrf
                                            
                                            @method('DELETE')
                                                <button 
                                                type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Elimina
                                                </button>
                                            </form>
    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </section>
@endsection