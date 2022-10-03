@extends('layouts.teamplate')
@php
    $stt = (($_GET['page']?? 1)-1)*5;
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cart</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header border-transparent">
            <form action="{{route('carts.index')}}" method="GET">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <input name="display_name" type="search" class="form-control form-control-lg"
                               placeholder="Search by display name" value="{{request('display_name')}}">
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
            <a type="button" class="btn btn-primary float-right" href="{{route('carts.create')}}">
                <i class="fas fa-plus"></i> Create
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0 table table-bordered table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($carts)!=0)
                        @foreach($carts as $cart)
                            <tr id="id{{$cart->id}}">
                                <td>{{++$stt}}</td>
                                <td>{{$cart->name}}</td>
                                <td>{{$cart->display_name}}</td>
                                <td style="overflow: hidden;">
                                    @foreach($cart->permissions as $item)
                                        <span class="badge badge-success">{{$item->name}}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-secondary" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                                        @hasPermission('show-cart')
                                        <a class="btn btn-primary btn-sm" href="{{route('carts.show',$cart->id)}}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        @endhasPermission
                                        @hasPermission('edit-cart')
                                        <a class="btn btn-info btn-sm" href="{{route('carts.edit',$cart->id)}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        @endhasPermission
                                        @hasPermission('delete-cart')
                                        <a class="btn btn-danger btn-sm delete" data-id="{{$cart->id}}">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </a>
                                        <form id="delete-{{ $cart->id }}"
                                              action="{{ route('carts.destroy',$cart->id) }}"
                                              method="post" style="display: none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        @endhasPermission
                                    </div>
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

                {{$carts->links()}}
            </div>


            <!-- /.table-responsive -->
        </div>
    </div>

@endsection
