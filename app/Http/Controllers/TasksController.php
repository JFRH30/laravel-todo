<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TasksController extends Controller
{

    public function index()
    {
        return view('pages.task.index', [
            'tasks' => Task::orderBy('due_date', 'desc')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->complete = false;
        $task->important = false;
        $task->save();

        return redirect('/');
    }

    public function edit($id)
    {
        return view('pages.task.edit', ['task' => Task::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->name = $request->name;
        $task->complete = $request->complete == 'on' ? true : false;
        $task->important = $request->important == 'on' ? true : false;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect('/');
    }

    public function mark($id)
    {
        $task = Task::find($id);
        $task->completed();

        return redirect('/');
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect('/');
    }
}
