@extends('layouts.main')

@section('title', 'Contacts')

@section('content')
<div class="row">
    {{-- Create contact --}}
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Create contact
                </h5>
                <form action="{{ url('contacts') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}

                </form>
            </div>
        </div>
    </div>
    {{-- End create contact --}}

    {{-- Contact list --}}
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
            <li class="list-group-item">item</li>
        </ul>
    </div>
    {{-- End contact list --}}
</div>
@endsection
