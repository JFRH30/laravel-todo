@extends('layouts.main')

@section('title', 'Appointment')

@section('content')
<div class="row">
    {{-- Create appointment --}}
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Set appointment with {{ $contact->first_name }} {{ $contact->last_name }} </h5>
                <hr>
                <form action="{{ url('appointment') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" name="attendee" value="{{ $contact->id }}">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <textarea name="location" id="location" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="date-start">Date start</label>
                            <input type="date" name="date_start" id="date-start" class="form-control">
                        </div>

                        <div class="col">
                            <label for="date-end">Date end</label>
                            <input type="date" name="date_end" id="date-end" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="time-start">Time start</label>
                            <input type="time" name="time_start" id="date-start" class="form-control">
                        </div>
                        <div class="col">
                            <label for="time-end">Time end</label>
                            <input type="time" name="time_end" id="time-end" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Set appointment</button>

                    <a href="{{ url('contact')}}" class="btn btn-outline-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    {{-- End create appointment --}}

    {{-- Appointment list --}}
    <div class="col-md-6">
        <h5>Appointment list with {{ $contact->first_name }} {{ $contact->last_name }}</h5>
        <ul class="list-group">
            @foreach ($appointments as $appointment)
                <li class="list-group-item d-flex align-items-center">
                    <div>
                        {{ $appointment->title }}
                        <br>
                        <small>Location : {{$appointment->location}}</small>
                    </div>

                    <div>
                        {{-- <small>Date {{ $appointment->date_start->diffForHumans($appointment->date_end) }} </small> --}}
                        {{-- <small>Date {{ $appointment->date_end }} </small> --}}
                        <small>Start {{ $appointment->time_start->diffInHours($appointment->time_end) }} </small>
                        <small>End {{ $appointment->time_end }} </small>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    {{-- End appointment list --}}
</div>
@endsection
