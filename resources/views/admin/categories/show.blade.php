@extends('layouts.teamplate')
@section('content')
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{$role->name}}</h3>
                <p class="text-muted text-center">{{$role->display_name}}</p>
                <div class="text-center">
                    @foreach($role->permissions as $item)
                        <span class="badge badge-success">{{$item->name}}</span>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endsection
