@extends('layouts.teamplate')
@section('content')
    <section class="content">
        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
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
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Display Name</label>
                                <input name="display_name" type="text" id="inputEmail" class="form-control"
                                       value="{{old('display_name')}}">
                            </div>
                            <div class="form-group">
                                <label>Select All</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="selectall" value="option1">
                                    <label for="selectall" class="custom-control-label"> Select ALL</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>User</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckboxUser"
                                           value="option1">
                                    <label for="customCheckboxUser" class="custom-control-label">All select</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <div class="row">
                                        @foreach($permissionsUser as $item)
                                            <div class="col-sm-4 col-md-2">
                                                <input name="permission_ids[]" class="custom-control-input"
                                                       type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                <label for="{{$item->name}}"
                                                       class="custom-control-label">{{$item->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Products</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckboxProduct"
                                           value="option1">
                                    <label for="customCheckboxProduct" class="custom-control-label">All select</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <div class="row">
                                        @foreach($permissionsProduct as $item)
                                            <div class="col-sm-4 col-md-2">
                                                <input name="permission_ids[]" class="custom-control-input"
                                                       type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                <label for="{{$item->name}}"
                                                       class="custom-control-label">{{$item->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckboxRole"
                                           value="option1">
                                    <label for="customCheckboxRole" class="custom-control-label">All select</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <div class="row">
                                        @foreach($permissionsRole as $item)
                                            <div class="col-sm-4 col-md-2">
                                                <input name="permission_ids[]" class="custom-control-input"
                                                       type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                <label for="{{$item->name}}"
                                                       class="custom-control-label">{{$item->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Categories</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckboxCategory"
                                           value="option1">
                                    <label for="customCheckboxCategory" class="custom-control-label">All select</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <div class="row">
                                        @foreach($permissionsCategory as $item)
                                            <div class="col-sm-4 col-md-2">
                                                <input name="permission_ids[]" class="custom-control-input"
                                                       type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
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
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
@endsection
