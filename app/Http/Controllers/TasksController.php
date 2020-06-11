<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class TasksController extends Controller
{

    public function index()
    {
        return view('pages.task.index', [
            'tasks' => User::find(Auth::id())->tasks()->orderBy('due_date', 'desc')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->user_id = Auth::id();
        $task->name = $request->name;
        $task->complete = false;
        $task->important = false;
        $task->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        return view('pages.task.edit', ['task' => Task::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if ($task->user_id != Auth::id()) {
            return redirect('/')->withErrors(['action_denied' => 'The action was denied.']);
        }

        $task->name = $request->name;
        $task->complete = $request->complete == 'on' ? true : false;
        $task->important = $request->important == 'on' ? true : false;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect('task');
    }

    public function mark($id)
    {
        $task = Task::find($id);
        $task->completed();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if ($task->user_id != Auth::id()) {
            return redirect('/')->withErrors(['action_denied' => 'The action was denied.']);
        }

        $task->delete();
        return redirect('task');
    }
}
