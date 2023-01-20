@extends('layouts.admin')

@section('content')

<div class="top_content d-flex">
    <h1 class="py-3">Project technologies panel</h1>
</div>


<div class="container pt-4">
    <div class="row">
        <div class="col-md-5">
            <h3 class="pb-4">Create a new technology</h3>
            <form class="" action="{{route('admin.technologies.store')}}" method="post">
                @csrf
                <div class="input-group mb-3" mt-4"">
                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="type name" aria-label="Type name" aria-describedby="basic-addon" value="{{ old('name') }}">
                    <button class="btn btn-secondary" type="submit">add technology</button>
                </div>
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </form>

        </div>
        <div class="col-md-7">
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
                            <th>name</th>
                            <th>slug</th>
                            <th>project count</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse($technologies as $technology)
                        <tr class="table-primary">
                            <td scope="row">{{$technology->id}}</td>
                            <td>
                                <form action="{{route('admin.technologies.update', $technology->slug)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="name" id="name" class="form-control bg-transparent" value="{{$technology->name}}">
                                    <small>Click to edit, press enter to update the technology name</small>
                                </form>
                            <td>{{$technology->slug}}</td>
                            <td>-</td>
                            <td>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTechnology-{{$technology->slug}}">
                                    <i class="fa-solid fa-trash text-white"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="deleteTechnology-{{$technology->slug}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTechnologyId-{{$technology->slug}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modaltechnologyId-{{$technology->slug}}">
                                                    Delete
                                                    technology</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Do you want to delete {{$technology->name}} project permanentely?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <form class="d-inline" action="{{route('admin.technologies.destroy', $technology->slug)}}" method="post">
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
                        <h3>No project technologies on database yet</h3>
                        @endforelse
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection