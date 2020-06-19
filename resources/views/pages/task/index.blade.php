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

    <div class="col-md-6">
        @if (count($tasks_wdate)>0 || count($tasks_wodate)>0)
        <h5>Task list</h5>
        @endif

        @if (count($tasks_wdate)>0)
            {{-- Task list with date --}}
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
            {{-- End task list with date --}}
        @endif

        @if (count($tasks_wodate)>0)
            {{-- Task list without date --}}
            <h6 class="mt-3">Not dated</h6>
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
            {{-- End task list without date --}}
        @endif
    </div>
</div>
@endsection
