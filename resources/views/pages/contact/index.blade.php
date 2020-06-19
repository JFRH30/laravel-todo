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
                <hr>
                <form action="{{ url('contact') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <div class="col">
                            <label for="first-name">First Name</label>
                            <input type="text" name="first_name" id="first-name" class="form-control" placeholder="Juan">
                        </div>

                        <div class="col">
                            <label for="last-name">Last Name</label>
                            <input type="text" name="last_name" id="lasr-name" class="form-control" placeholder="Dela Cruz">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
    {{-- End create contact --}}

    {{-- Contact list --}}
    <div class="col-md-6">
        @if (count($contacts)>0)
            <h5>Contact list</h5>
        @endif

        <ul class="list-group">
            @foreach ($contacts as $contact)
                <li class="list-group-item d-flex align-items-center">
                    <div>
                        <strong>{{ $contact->first_name }} {{ $contact->last_name }}</strong>
                        <br>
                        <small>Email : {{ $contact->email }}</small>
                    </div>

                    {{-- Create appointment --}}
                    <a href="{{ url('contact/'.$contact->id.'/appointment') }}" class="btn btn-success ml-auto mr-1"  data-toggle="tooltip" data-placement="top" title="Appointment">
                        <i class="far fa-handshake"></i>
                    </a>
                    {{-- End create appointment --}}

                    {{-- Edit contact --}}
                    <a href="{{ url('contact/'.$contact->id.'/edit') }}" class="btn btn-info mr-1"  data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="far fa-edit"></i>
                    </a>
                    {{-- End edit contact --}}

                    {{-- Delete contact --}}
                    <form action="{{ url('contact/'.$contact->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                    {{-- End delete contact --}}
                </li>
            @endforeach
        </ul>
    </div>
    {{-- End contact list --}}
</div>
@endsection
