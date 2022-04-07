@extends('layouts.teamplate')
@section('content')
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->email}}</p>
                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
@endsection
