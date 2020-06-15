@extends('layouts.main')

@section('title', 'Update task')

@section('content')
    <div class="card offset-md-3 col-12 col-md-6 mt-3">
        <div class="card-body">
            <form action="{{ url('task/'.$task->id.'/update') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                <div class="form-group mx-sm-3 mr-3">
                    <label for="task-name" class="control-label mr-3"> Task name:</label>
                    <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
                </div>
                <br>
                <div class="form-group mx-sm-3 mr-3">
                    <input type="checkbox" name="complete" id="task-complete" {{ $task->complete ? 'checked' : '' }}>
                    <label for="task-complete" class="control-label mr-3">Complete</label>

                    <input type="checkbox" name="important" id="task-important" {{ $task->important ? 'checked' : '' }}>
                    <label for="task-important" class="control-label mr-3">Important</label>
                </div>

                <div class="form-group mx-sm-3 mr-3">
                    <label for="task-due" class="control-label mr-3"> Due date:</label>
                    <input type="datetime-local" name="due_date" id="task-due" class="form-control" value="{{ $task->due_date ? $task->due_date->toDateTimeLocalString() : '' }}">
                </div>

                <button type="submit" class="btn btn-primary"> Update Task</button>
                <a href="{{ url('task') }}" class="btn btn-outline-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
