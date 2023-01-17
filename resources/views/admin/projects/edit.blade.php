@extends('layouts.admin')

@section('content')

<div class="top_content d-flex">
    <h1 class="py-3">Edit Project {{($project->title)}}</h1>

</div>

@include('partials.errors')
<form action="{{route('admin.projects.update', $project->slug)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('title', $project->title) }}">
        <small id="helpId" class="text-muted">Insert title, max 100 characters, required field</small>
    </div>
    @error('title')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('slug', $project->slug) }}">
        <small id="helpId" class="text-muted">Required field</small>
    </div>
    @error('slug')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <img class="edit_form_img" src="{{asset('storage/' . $project->cover_image)}}" alt="">
        <label for="cover_image" class="form-label">Edit cover image</label>
        <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Edit cover image</small>
    </div>
    @error('cover_image')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="" aria-describedby="helpId">{{ old('description', $project->description) }}</textarea>
    </div>
    @error('description')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <button class="btn btn-primary" type="submit">Edit Project</button>

</form>
@endsection