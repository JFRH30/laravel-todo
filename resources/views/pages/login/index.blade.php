@extends('layouts.pre-login')

@section('title', 'Login')

@section('content')
<div class="col-12 col-sm-6 col-md-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Login</h5>

            <form action="{{ url('login') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com">
                </div>

                <div class="form-group mb-1">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>

                <hr>

                <a href="{{ url('register') }}"  class="d-block mb-3">
                    <small>Doesn't have account?</small>
                </a>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
