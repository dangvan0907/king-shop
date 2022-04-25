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
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{$category->name}}</h3>
                <div class="text-center">
                        <span class="badge badge-success">{{$category->parentCategory->name??'Parent'}}</span>
                </div>
            </div>
        </div>

    </section>
@endsection
