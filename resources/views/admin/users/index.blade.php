@extends('layouts.teamplate')
@php
    $stt = (($_GET['page']?? 1)-1)*5;
@endphp
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
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{route('users.index')}}" method="GET">
                            <div class="form-group search-product">
                                <div class="input-group input-group-sm">
                                    <input name="email" type="search" class="form-control form-control-lg name-search"
                                           placeholder="Search by email" value="{{request('email')}}">
                                    <input name="name" type="search" class="form-control form-control-lg name-search"
                                           placeholder="Search by name" value="{{request('name')}}">
                                    <select name="role_id" class="form-control form-control-lg">
                                        <option value="0" selected>Select All</option>
                                        @foreach($roles as $role)
                                            @if(request('role_id')==$role->id)
                                                <option selected value="{{$role->id}}">{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-default btn-search">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- /.card-header -->
                        <div class="card-footer clearfix text-danger">
                            @if(session('message'))
                                <p id="messageSession" hidden>{{session('message')}}</p>
                            @endif
                            <a type="button" class="btn btn-primary float-right" href="{{route('users.create')}}">
                                <i class="fas fa-plus"></i> Create
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($users)!=0)
                                    @foreach($users as $user)
                                        <tr id="id{{$user->id}}">
                                            <td class="text-center">{{++$stt}}</td>
                                            <td class="text-center">{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    <span class="badge badge-success">{{$role->display_name}}</span>
                                                @endforeach
                                            </td>
                                            <td class="project-actions text-center">
                                                @hasPermission('show-user')
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{route('users.show',$user->id)}}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                @endhasPermission
                                                @hasPermission('edit-user')
                                                <a class="btn btn-info btn-sm" href="{{route('users.edit',$user->id)}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                @endhasPermission
                                                @hasPermission('delete-user')
                                                @if(auth()->user()->id!=$user->id)
                                                    <a class="btn btn-danger btn-sm delete" data-id="{{$user->id}}">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </a>
                                                    <form id="delete-{{ $user->id }}"
                                                          action="{{ route('users.destroy',$user->id) }}"
                                                          method="post" style="display: none">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                @endif
                                                @endhasPermission

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                </tbody>
                            </table>
                            <p class="text-center">no data</p>
                            @endif
                            {{$users->appends(request()->all())->links()}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
