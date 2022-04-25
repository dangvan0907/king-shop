@extends('layouts.teamplate')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Role</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <form action="{{route('roles.store')}}" method="POST">
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
                        <div class="card">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input name="name" type="text" id="inputName" class="form-control"
                                       value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Display Name</label>
                                <input name="display_name" type="text" id="inputEmail" class="form-control"
                                       value="{{old('display_name')}}">
                                @if ($errors->has('display_name'))
                                    <p class="text-danger">{{ $errors->first('display_name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="checkAll" value="option1">
                                    <label for="checkAll" class="custom-control-label"> Select ALL</label>
                                </div>
                            </div>
                            <div id="list-wrapper">
                                <div class="form-group">
                                    <label>User</label>
                                    <div class="custom-control custom-checkbox parent">
                                        <input class="custom-control-input user-parent" type="checkbox"
                                               id="customCheckboxUser">
                                        <label for="customCheckboxUser" class="custom-control-label">All select</label>
                                    </div>
                                    <div class="custom-control custom-checkbox user-item">
                                        <div class="row">
                                            @foreach($permissionsUser as $item)
                                                <div class="col-sm-4 col-md-2">
                                                    <input name="permission_ids[]" class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}"
                                                        {{(is_array(old('permission_ids')) and  in_array($item->id,old('permission_ids'))) ? 'checked' : '' }}>
                                                    <label for="{{$item->name}}"
                                                           class="custom-control-label">{{$item->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Products</label>
                                    <div class="custom-control custom-checkbox parent">
                                        <input class="custom-control-input product-parent" type="checkbox"
                                               id="customCheckboxProduct"
                                               value="option1">
                                        <label for="customCheckboxProduct" class="custom-control-label">All
                                            select</label>
                                    </div>
                                    <div class="custom-control custom-checkbox product-item">
                                        <div class="row">
                                            @foreach($permissionsProduct as $item)
                                                <div class="col-sm-4 col-md-2">
                                                    <input name="permission_ids[]" class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}"
                                                        {{(is_array(old('permission_ids')) and  in_array($item->id,old('permission_ids'))) ? 'checked' : '' }}>

                                                    <label for="{{$item->name}}"
                                                           class="custom-control-label">{{$item->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <div class="custom-control custom-checkbox parent">
                                        <input class="custom-control-input role-parent" type="checkbox"
                                               id="customCheckboxRole"
                                               value="option1">
                                        <label for="customCheckboxRole" class="custom-control-label">All select</label>
                                    </div>
                                    <div class="custom-control custom-checkbox role-item">
                                        <div class="row">
                                            @foreach($permissionsRole as $item)
                                                <div class="col-sm-4 col-md-2">
                                                    <input name="permission_ids[]" class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}"
                                                        {{(is_array(old('permission_ids')) and  in_array($item->id,old('permission_ids'))) ? 'checked' : '' }}>

                                                    <label for="{{$item->name}}"
                                                           class="custom-control-label">{{$item->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Categories</label>
                                    <div class="custom-control custom-checkbox parent">
                                        <input class="custom-control-input category-parent" type="checkbox"
                                               id="customCheckboxCategory"
                                               value="option1">
                                        <label for="customCheckboxCategory" class="custom-control-label">All
                                            select</label>
                                    </div>
                                    <div class="custom-control custom-checkbox category-item">
                                        <div class="row">
                                            @foreach($permissionsCategory as $item)
                                                <div class="col-sm-4 col-md-2">
                                                    <input name="permission_ids[]"
                                                           class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}"
                                                        {{(is_array(old('permission_ids')) and  in_array($item->id,old('permission_ids'))) ? 'checked' : '' }}>

                                                    <label for="{{$item->name}}"
                                                           class="custom-control-label">{{$item->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
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
