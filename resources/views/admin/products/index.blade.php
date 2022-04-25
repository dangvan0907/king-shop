@extends('layouts.teamplate')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card products-list">
        <section class="content">
            <div class="container-fluid">
        <div class="card-header border-transparent">
            <form id="searchProduct" data-action="{{route('products.list')}}">
                <div class="form-group search-product">
                    <div class="input-group input-group-sm">
                        <input name="name" type="search" class="form-control form-control-lg name-search"
                               placeholder="Search by name" value="{{request('name')}}">
                        <input name="min_price" type="search" class="form-control form-control-lg min-price-search"
                               placeholder="Search by min price" value="{{request('min_price')}}">
                        <select name="category_id" id="category_id" value="{{request('category_id')}}" class="form-control form-control-lg categories">
                            <option value="0">Select All</option>
                            @foreach($categoryChildren as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <input name="max_price" type="search" class="form-control form-control-lg max-price-search"
                               placeholder="Search by max price" value="{{request('max_price')}}">

                    </div>
                </div>
            </form>
        </div>
            </div>
        </section>

        <div class="card-footer clearfix">
            <div class="float-lg-left" id="success_message"></div>
            <button id="createProduct" type="button" class="btn btn-primary float-right createProduct" data-toggle="modal"
                    data-target="#createProductModal">
                <i class="fas fa-plus"></i> Create
            </button>
        </div>
        @include('admin.products.show')
        @include('admin.products.create')
        @include('admin.products.edit')
        <div class="card-body p-0 list-product" id="list" data-action="{{route('products.list')}}">
        </div>


    </div>

@endsection
@push('scripts')
    <script src="{{asset('admin/js/pagination.js')}}"></script>
    <script  src="{{asset("admin/js/product.js")}}"></script>
@endpush
