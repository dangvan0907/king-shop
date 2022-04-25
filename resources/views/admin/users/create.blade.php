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
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <form action="{{route('users.store')}}" method="POST" autocomplete="on">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input name="name" type="text" id="inputName" class="form-control" value="{{old('name')??''}}">
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="text" id="inputEmail" class="form-control" value="{{old('email')??''}}">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputPassWord">Password</label>
                                <input name="password" type="password" id="inputPassWord" class="form-control" value="{{old('password')??''}}">
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Roles</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="checkAll">
                                    <label for="checkAll" class="custom-control-label">All select</label>
                                </div>
                                <div class="custom-control custom-checkbox" id="list-wrapper">
                                    <div class="row">
                                        @foreach($roles as $role)
                                            <div class="col-sm-4 col-md-3">
                                                <input name="role_ids[]" class="custom-control-input checktest" type="checkbox" id="{{$role->id}}" value="{{$role->id}}"
                                                    {{(is_array(old('role_ids')) and  in_array($role->id,old('role_ids'))) ? 'checked' : '' }}>

                                                <label for="{{$role->id}}" class="custom-control-label">{{$role->display_name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
@endsection
