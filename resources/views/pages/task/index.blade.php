@extends('layouts.main')

@section('title', 'Task list')

@section('content')

<div class="row">
    {{-- Create task --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Create task
                </h5>
                <hr>
                <form action="{{ url('task') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="task-name" class="control-label">Task name</label>
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Add task</button>
                </form>
            </div>
        </div>
    </div>
    {{-- End create task --}}

    {{-- Task list --}}
    <div class="col-md-6">
        <h5>Task list</h5>
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex align-items-center">
                    {{-- Mark complete --}}
                    <form action="{{ url('task/'.$task->id.'/mark') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input
                            type="checkbox"
                            name="complete"
                            onclick="this.form.submit()"
                            class="mr-3" {{ $task->complete ? 'checked' : ''}}>
                    </form>
                    {{-- End mark complete --}}

                    <div>
                        {{-- Check if important --}}
                        @if ($task->important)
                            <strong>{{ $task->name }}</strong>
                        @else
                            {{ $task->name }}
                        @endif
                        {{-- End check if important --}}
                        <br>
                        <small>Due Date : {{ $task->due_date ? $task->due_date->format('l, M. j Y | g:i a') : 'Not set'}}</small>
                    </div>

                    {{-- Edit task --}}
                    <a href="{{ url('task/'.$task->id.'/edit') }}" class="btn btn-warning ml-auto mr-3">Edit</a>
                    {{-- End edit task --}}

                    {{-- Delete Task --}}
                    <form action="{{ url('task/'.$task->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                    {{-- End delete task --}}
                </li>
            @endforeach
        </ul>
    </div>
    {{-- End task list --}}
</div>
@endsection
