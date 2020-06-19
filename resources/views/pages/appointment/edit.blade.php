@extends('layouts.main')

@section('title', 'Update appointment')

@section('content')
<div class="col-md-6 offset-md-3 mb-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Update appointment</h5>
            <hr>
            <form action="{{ url('appointment/'.$appointment->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $appointment->title }}">
                </div>

                <div class="form-group">
                    <label for="attendee">Client</label>
                    <select name="attendee" id="attendee" class="custom-select custom-select-lg">
                        <option value="{{ $appointment->contact_id }}" selected>{{ $appointment->contact->last_name }} {{ $appointment->contact->first_name }}</option>
                        @foreach ($contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->last_name }} {{ $contact->first_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <textarea name="location" id="location" class="form-control" rows="3">{{ $appointment->location }}</textarea>
                </div>

                <div class="form-group">
                    <label for="date-start">Date start</label>
                    <input type="date" name="date_start" id="date-start" class="form-control"  value="{{ $appointment->date_start->toDateString() }}">
                </div>

                <div class="form-group row">
                    <div class="col">
                        <label for="time-start">Time start</label>
                        <input type="time" name="time_start" id="time-start" class="form-control"  value="{{ $appointment->time_start->toTimeString() }}">
                    </div>

                    <div class="col">
                        <label for="time-end">Time end</label>
                        <input type="time" name="time_end" id="time-end" class="form-control" value="{{ $appointment->time_end->toTimeString() }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update appointment</button>

                <a href="{{ url('appointment') }}" class="btn btn-outline-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
