@extends('layouts.admin')

@section('content')
<div class="content d-flex flex-column">

    <h1 class="py-3">Project {{$project->title}}</h1>

    <div class="bottom_content">
        @if($project->cover_img)
        <img class="img-fluid mb-3" src="{{asset('storage/' . $project->cover_img)}}" alt="">
        @endif
        <h4>Project title: </h4>
        <p>{{$project->title}}</p>
        <h4>Project slug: </h4>
        <p>{{$project->slug}}</p>
        <h4>Type: </h4>
        <p>{{$project->type ? $project->type->name : 'No type'}}</p>
        <!-- c'è una tipologia assegnata? se si, mostra il nome, altrimenti No type -->
        <h4>Technologies: </h4>
        <!-- se le tecnologie nella lista sono più di 0 le mostro -->
        @if(count($project->technologies) > 0)
        <!-- per ogni tecnologia assegnata mostro in nome -->
        @foreach($project->technologies as $technology)
        <p>{{$technology->name}}</p>
        @endforeach

        @else
        <p>No technology assigned for this project</p>
        @endif

        <h4>Project description: </h4>
        <p>{{$project->description}}</p>
    </div>

    <a class="btn btn-warning mt-5 ms-auto" href="{{route('admin.projects.edit', $project->slug)}}"><i class="fa-solid fa-pencil"></i> edit</a>

</div>

@endsection