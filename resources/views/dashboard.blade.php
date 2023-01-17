@extends('layouts.admin')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <a href="{{route('admin.projects.create')}}" class="btn btn-primary ms-auto align-self-center mt-3">Add
                Project</a>
        </div>
    </div>
</div>
@endsection