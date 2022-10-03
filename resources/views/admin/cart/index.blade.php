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
        <div class="card-footer clearfix">
            @if(session('message'))
                <p id="messageSession" hidden>{{session('message')}}</p>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0 table table-bordered table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Sub Total</th>
                        <th>Shipping</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($carts)!=0)
                        @foreach($carts as $cart)
                            <tr id="id{{$cart->id}}" class="text-center">
                                <td>{{++$stt}}</td>
                                <td>{{$cart->userLogin->name}}</td>
                                <td>{{$cart->status}}</td>
                                <td>{{$cart->sub_total}}</td>
                                <td>{{$cart->shipping}}</td>
                                <td>{{$cart->total}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{route('carts.show',$cart->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
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
