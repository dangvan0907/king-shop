@extends('layouts.teamplate')
@section('content')
    <section class="content">
        <form action="{{route('roles.update',$role->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input disabled name="name" type="text" id="inputName" class="form-control"
                                       value="{{$role->name}}">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Display Name</label>
                                <input name="email" type="text" id="inputEmail" class="form-control"
                                       value="{{$role->display_name}}">
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
                                                @if($role->hasPermission($item->name))
                                                    <input name="permission_ids[]" checked class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @else
                                                    <input name="permission_ids[]" class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @endif
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
                                                @if($role->hasPermission($item->name))
                                                    <input name="permission_ids[]" checked class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @else
                                                    <input name="permission_ids[]" class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @endif
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
                                                @if($role->hasPermission($item->name))
                                                    <input name="permission_ids[]" checked class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @else
                                                    <input name="permission_ids[]" class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @endif
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
                                                @if($role->hasPermission($item->name))
                                                    <input name="permission_ids[]" checked class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @else
                                                    <input name="permission_ids[]" class="custom-control-input"
                                                           type="checkbox" id="{{$item->name}}" value="{{$item->id}}">
                                                @endif
                                                <label for="{{$item->name}}"
                                                       class="custom-control-label">{{$item->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
