@extends('layouts.teamplate')
@php
    $stt = (($_GET['page']?? 1)-1)*5;
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category Parent</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Category Parent</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header border-transparent">
            <form action="{{route('categories.index')}}" method="GET">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <input name="name" type="search" class="form-control form-control-lg"
                               placeholder="Search by name" value="{{request('name')}}">
                        <select name="parent_id" class="form-control form-control-lg">
                            <option value="0" selected>Select All</option>
                            @foreach($categoryParents as $categoryParent)
                                @if(request('parent_id')==$categoryParent->id)
                                    <option selected value="{{$categoryParent->id}}">{{$categoryParent->name}}</option>
                                @else
                                    <option value="{{$categoryParent->id}}">{{$categoryParent->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer clearfix">
            @if(session('message'))
                <p id="messageSession" hidden>{{session('message')}}</p>
            @endif
            <a type="button" class="btn btn-primary float-right" href="{{route('categories.create')}}">
                <i class="fas fa-plus"></i> Create
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0 table table-bordered table-hover text-center">
                    <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($categories)!=0)
                        @foreach($categories as $category)
                            <tr id="id{{$category->id}}" class="text-center" id="id{{$category->id}}">
                                <td>{{++$stt}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->parent->name??''}}</td>
                                <td class="project-actions text-center">
                                    @hasPermission('show-category')
                                    <a class="btn btn-primary btn-sm" href="{{route('categories.show',$category->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    @endhasPermission
                                    @hasPermission('edit-category')
                                    <a class="btn btn-info btn-sm" href="{{route('categories.edit',$category->id)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    @endhasPermission
                                    @hasPermission('delete-category')
                                    <a class="btn btn-danger btn-sm delete" data-id="{{$category->id}}">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </a>
                                    <form id="delete-{{ $category->id }}"
                                          action="{{ route('categories.destroy',$category->id) }}"
                                          method="post" style="display: none">
                                        @csrf
                                        @method('delete')
                                    </form>
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

                {{$categories->links()}}
            </div>
        </div>
    </div>

@endsection
