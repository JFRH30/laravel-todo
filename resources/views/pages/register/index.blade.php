@extends('layouts.main')

@section('content')
    <div class="card offset-3 col-6 px-0">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">
            <form action="{{ url('register') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first_name" id="first-name" class="form-control" placeholder="Juan">
                    </div>
                    <div class="col">
                        <label for="lasr-name">Last Name</label>
                        <input type="text" name="last_name" id="lasr-name" class="form-control" placeholder="Dela Cruz">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com">
                </div>
                <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ url('/') }}" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
@endsection
