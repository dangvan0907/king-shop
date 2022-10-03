@extends('layouts.teamplate')

@php
    $stt = (($_GET['page']?? 1)-1)*5;
@endphp

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Carts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('carts.index')}}">Carts</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <table class="table m-0 table table-bordered table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Cart Id</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($cart->cartItems)!=0)
                        @foreach($cart->cartItems as $cartItem)
                            <tr id="id{{$cart->id}}" class="text-center">
                                <td>{{++$stt}}</td>
                                <td>{{$cartItem->product->name}}</td>
                                <td>{{$cartItem->cart_id}}</td>
                                <td>{{$cartItem->price}}</td>
                                <td>{{$cartItem->quantity}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    </tbody>
                </table>
                <p class="text-center">no data</p>
                @endif
            </div>
        </div>

    </section>
@endsection
