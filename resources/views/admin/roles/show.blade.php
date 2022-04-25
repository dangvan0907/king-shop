@extends('layouts.teamplate')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Role</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{$role->name}}</h3>
                <p class="text-muted text-center">{{$role->display_name}}</p>
                <div class="text-center">
                    @foreach($role->permissions as $item)
                        <span class="badge badge-success">{{$item->name}}</span>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endsection
