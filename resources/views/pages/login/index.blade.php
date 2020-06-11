@extends('layouts.main')

@section('content')
    <div class="card offset-4 col-4 px-0">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <form action="{{ url('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ url('/') }}" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
@endsection
