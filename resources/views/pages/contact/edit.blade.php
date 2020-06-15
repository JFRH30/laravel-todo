@extends('layouts.main')

@section('title', 'Update contact')

@section('content')
<div class="col-md-6 offset-3 mb-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Update contact
            </h5>
            <hr>
            <form action="{{ url('contact/'.$contact->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group row">
                    <div class="col">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first_name" id="first-name" class="form-control" placeholder="Juan" value="{{ $contact->first_name }}">
                    </div>
                    <div class="col">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last_name" id="lasr-name" class="form-control" placeholder="Dela Cruz" value="{{ $contact->last_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com" value="{{ $contact->email }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('contact') }}" class="btn btn-outline-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
