@extends('layouts.admin')

@section('content')

<div class="top_content d-flex">
    <h1 class="py-3">Projects</h1>
    <a href="{{route('admin.projects.create')}}" class="btn btn-primary ms-auto align-self-center">Add Project</a>
</div>

@if(session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    <strong>{{session('message')}}</strong>
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped
    table-hover	
    table-borderless
    table-primary
    align-middle">
        <thead class="table-light">
            <tr>
                <th>id</th>
                <th>image</th>
                <th>title</th>
                <th>slug</th>
                <!-- <th>description</th> -->
                <th>actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse($projects as $project)
            <tr class="table-primary">
                <td scope="row">{{$project->id}}</td>
                <td><img class="edit_form_img" src="{{asset('storage/' . $project->cover_img)}}" alt=""></td>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <!-- <td>{{$project->description}}</td> -->
                <td>
                    <a class="btn btn-primary" href="{{route('admin.projects.show', $project->slug)}}"><i class="fa-solid fa-eye"></i></a>
                    <a class="btn btn-warning" href="{{route('admin.projects.edit', $project->slug)}}"><i class="fa-solid fa-pencil"></i></a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProject-{{$project->id}}">
                        <i class="fa-solid fa-trash text-white"></i>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="deleteProject-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalProjectId-{{$project->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalProjectId-{{$project->id}}">Delete Project</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Do you want to delete this project permanentely?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <form class="d-inline" action="{{route('admin.projects.destroy', $project->slug)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <h3>No projects on database yet</h3>
            @endforelse
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>

@endsection