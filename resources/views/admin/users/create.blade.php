@extends('layouts.teamplate')
@section('content')
    <section class="content">
        <form action="{{route('users.store')}}" method="POST">
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
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input name="name" type="text" id="inputName" class="form-control" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="text" id="inputEmail" class="form-control" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="inputPassWord">PassWord</label>
                                <input name="password" type="text" id="inputPassWord" class="form-control" value="{{old('password')}}">
                            </div>
                            <div class="form-group">
                                <label for="inputPassWordd">PassWord_d</label>
                                <input name="passwordd" type="text" id="inputPassWordd" class="form-control" value="{{old('passwordd')}}">
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
