@extends('layouts.main')

@section('title', 'Appointment')

@section('content')
<div class="row">
    {{-- Create appointment --}}
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Set an appointment</h5>
                <hr>
                <form action="{{ url('appointment') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="attendee">Client</label>
                        <select name="attendee" id="attendee" class="custom-select custom-select-lg">
                            <option value="attendee_none" selected>Please select contact.</option>
                            @foreach ($contacts as $contact)
                                <option value="{{ $contact->id }}">{{ $contact->last_name }} {{ $contact->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <textarea name="location" id="location" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date-start">Date start</label>
                        <input type="date" name="date_start" id="date-start" class="form-control">
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="time-start">Time start</label>
                            <input type="time" name="time_start" id="time-start" class="form-control">
                        </div>

                        <div class="col">
                            <label for="time-end">Time end</label>
                            <input type="time" name="time_end" id="time-end" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Set appointment</button>
                </form>
            </div>
        </div>
    </div>
    {{-- End create appointment --}}

    {{-- Appointment list --}}
    <div class="col-md-6">
        @if (count($appointments)>0)
            <h5>Appointment list</h5>
        @endif

        <ul class="list-group">
            @foreach ($appointments as $appointment)
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-auto">
                        {{ $appointment->title }} with {{ $appointment->contact->last_name }} {{ $appointment->contact->first_name }}
                        <br>
                        <small>
                            <strong>Location : </strong>{{$appointment->location}}</small>
                        <br>
                        <small>
                            <strong>Date : </strong>{{ $appointment->date_start->format('l, M. j Y') }}
                            <strong class="ml-2">Start : </strong>{{ $appointment->time_start->format('g:i a') }}
                            <strong>End : </strong>{{ $appointment->time_end->format('g:i a') }}
                        </small>
                    </div>

                    {{-- Edit appointment --}}
                    <a href="{{ url('appointment/'.$appointment->id.'/edit') }}" class="btn btn-info mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="far fa-edit"></i>
                    </a>
                    {{-- End edit appointment --}}

                    {{-- Delete appointment --}}
                    <form action="{{ url('appointment/'.$appointment->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                    {{-- End delete appointment --}}
                </li>
            @endforeach
        </ul>
    </div>
    {{-- End appointment list --}}
</div>
@endsection
