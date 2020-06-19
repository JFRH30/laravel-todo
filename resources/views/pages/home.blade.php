@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
{{-- Cards --}}
<div class="row">
    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="bg-success text-white rounded-circle p-3 mr-3">
                        <i class="far fa-handshake fa-lg"></i>
                    </span>

                    <div>
                        <h5 class="font-weight-bold">
                            {{ count($appointments) }}
                        </h5>
                        <small class="text-uppercase text-muted">
                            Appointments
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="bg-info text-white rounded-circle p-3 mr-3">
                        <i class="far fa-edit fa-lg"></i>
                    </span>

                    <div>
                        <h5 class="font-weight-bold">
                            {{ count($tasks_wdate) + count($tasks_wodate) }}
                        </h5>
                        <small class="text-uppercase text-muted">
                            Tasks
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="bg-danger text-white rounded-circle p-3 mr-3">
                        <i class="fas fa-users fa-lg"></i>
                    </span>

                    <div>
                        <h5 class="font-weight-bold">
                            {{ count($contacts) }}
                        </h5>
                        <small class="text-uppercase text-muted">
                            Contacts
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End cards --}}

<hr>

{{-- Quick list --}}
<div class="row">
    <div class="col-md-6">
        {{-- Appointment list --}}
        <h5 class="pb-2 border-bottom border-success">Appointment list</h5>

        @if (count($appointments) > 0)
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
        @else
            <p class="my-5 text-center text-uppercase font-weight-bold">
                No appointments yet.
            </p>
        @endif
        {{-- End Appointment --}}

        {{-- Contact list --}}
        <h5 class="pb-2 mt-2 border-bottom border-danger">Contact list</h5>

        @if (count($contacts) > 0)
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
        @else
            <p class="my-5 text-center text-uppercase font-weight-bold">
                No contacts saved yet.
            </p>
        @endif
        {{-- End contact list --}}
    </div>

    <div class="col-md-6">
        <h5 class="pb-2 mt-2 mt-md-0 border-bottom border-info">Task list</h5>

        @if ((count($tasks_wdate) + count($tasks_wodate)) > 0)
            {{-- Tasks dated --}}
            @if (count($tasks_wdate) > 0)
            <h6>Dated</h6>
            <ul class="list-group">
                @foreach ($tasks_wdate as $task_wdate)
                <li class="list-group-item d-flex align-items-center">
                        {{-- Mark complete --}}
                        <form action="{{ url('task/'.$task_wdate->id.'/mark') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input
                                type="checkbox"
                                name="complete"
                                onclick="this.form.submit()"
                                class="mr-3" {{ $task_wdate->complete ? 'checked' : ''}}
                                data-toggle="tooltip" data-placement="top"
                                title="{{ $task_wdate->complete ? 'Undone' : 'Done'}} ">
                        </form>
                        {{-- End mark complete --}}

                        <div>
                            {{-- Check if important --}}
                            @if ($task_wdate->important)
                                <strong>{{ $task_wdate->name }}</strong>
                            @else
                                {{ $task_wdate->name }}
                            @endif
                            {{-- End check if important --}}
                            <br>
                            <small>Due Date : {{ $task_wdate->due_date ? $task_wdate->due_date->format('l, M. j Y | g:i a') : 'Not set'}}</small>
                        </div>

                        {{-- Edit task --}}
                        <a href="{{ url('task/'.$task_wdate->id.'/edit') }}" class="btn btn-info ml-auto mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="far fa-edit"></i>
                        </a>
                        {{-- End edit task --}}

                        {{-- Delete Task --}}
                        <form action="{{ url('task/'.$task_wdate->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                            <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                        {{-- End delete task --}}
                    </li>
                @endforeach
            </ul>
            @endif
            {{-- End task dated --}}

            {{-- Task without date --}}
            @if (count($tasks_wodate) > 0)
            <h6 class="mt-2">Not dated</h6>
            <ul class="list-group">
                @foreach ($tasks_wodate as $task_wodate)
                    <li class="list-group-item d-flex align-items-center">
                        {{-- Mark complete --}}
                        <form action="{{ url('task/'.$task_wodate->id.'/mark') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input
                                type="checkbox"
                                name="complete"
                                onclick="this.form.submit()"
                                class="mr-3" {{ $task_wodate->complete ? 'checked' : ''}}
                                data-toggle="tooltip" data-placement="top"
                                title="{{ $task_wodate->complete ? 'Undone' : 'Done'}} ">
                        </form>
                        {{-- End mark complete --}}

                        <div>
                            {{-- Check if important --}}
                            @if ($task_wodate->important)
                                <strong>{{ $task_wodate->name }}</strong>
                            @else
                                {{ $task_wodate->name }}
                            @endif
                            {{-- End check if important --}}
                            <br>
                            <small>Due Date : {{ $task_wodate->due_date ? $task_wodate->due_date->format('l, M. j Y | g:i a') : 'Not set'}}</small>
                        </div>

                        {{-- Edit task --}}
                        <a href="{{ url('task/'.$task_wodate->id.'/edit') }}" class="btn btn-info ml-auto mr-1"  data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="far fa-edit"></i>
                        </a>
                        {{-- End edit task --}}

                        {{-- Delete Task --}}
                        <form action="{{ url('task/'.$task_wodate->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                            <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                        {{-- End delete task --}}
                    </li>
                @endforeach
            </ul>
            @endif
            {{-- End task without date --}}
        @else
            <p class="my-5 text-center text-uppercase font-weight-bold">
                No task yet.
            </p>
        @endif
    </div>
</div>
{{-- End quick list --}}
@endsection
