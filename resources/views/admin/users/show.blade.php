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
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">User</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{$user->name}}</h3>
                <p class="text-muted text-center">{{$user->email}}</p>
                <div class="text-center">
                    @foreach($user->roles as $role)
                        <span class="badge badge-success">{{$role->display_name}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
