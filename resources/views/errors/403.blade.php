@extends('errors::minimal')

{{--@section('title', __('Forbidden'))--}}
@section('code', '403')

{{--@section('message', __($exception->getMessage() ?: 'Forbidden'))--}}
@section('message')
<div class="content-wrapper">
    <section class="content">
        <div class="error-page">
{{--            <h2 class="headline text-warning"> 403</h2>--}}

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page Forbidden.</h3>

                <p>
                    You do not have permission to access this url.
                    Meanwhile, you may<br>
                    <a style="background-color: red" href="{{route('home')}}">return to dashboard</a> or try using the search form.
                </p>

                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
@endsection
