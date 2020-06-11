@extends('layouts.main')

@section('content')

        {{-- Create Task --}}
        <div class="card offset-md-3 col-12 col-md-6 mt-3">
            <div class="card-body">
                <form action="{{ url('task') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group mx-sm-3 mr-3">
                        <label for="task-name" class="control-label mr-3"> Create task:</label>
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary"> Add Task</button>
                </form>
            </div>
        </div>

        {{-- Show Task --}}
        <div class="offset-md-3 col-12 col-md-6 mt-3 px-0">
            <ul class="list-group">
                @foreach ($tasks as $task)
                    <li class="list-group-item d-flex align-items-center">
                        {{-- Mark Complete --}}
                        <form action="{{ url('task/'.$task->id.'/mark') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input
                                type="checkbox"
                                name="complete"
                                onclick="this.form.submit()"
                                class="mr-3" {{ $task->complete ? 'checked' : ''}}>
                        </form>

                        <div>
                            {{-- Check if Important --}}

                            @if ($task->important)
                                <strong>{{ $task->name }}</strong>
                            @else
                                {{ $task->name }}
                            @endif
                            <br>
                            <small>Due Date: {{ $task->due_date ? $task->due_date->format('g:ia l jS F Y') : 'Not set'}}</small>
                        </div>

                        {{-- Edit Task --}}
                        <a href="{{ url('task/'.$task->id.'/edit') }}" class="btn btn-warning ml-auto mr-3">Edit</a>

                        {{-- Delete Task --}}
                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

@endsection
