<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class TasksController extends Controller
{

    /**
     * Display task index page along with users task collection.
     */
    public function index()
    {
        return view('pages.task.index', [
            'tasks' => User::find(Auth::id())->tasks()->orderBy('due_date', 'desc')->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Validate and store request.
     */
    public function store(Request $request)
    {
        // Validate request.
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // Store task record.
        $task = new Task;
        $task->user_id = Auth::id();
        $task->name = $request->name;
        $task->complete = false;
        $task->important = false;
        $task->save();

        return redirect()->back();
    }

    /**
     * Display task edit page along with the selected task info.
     */
    public function edit($id)
    {
        return view('pages.task.edit', ['task' => Task::find($id)]);
    }

    /**
     * Update task.
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        // Check if the logged user own this task.
        if ($task->user_id != Auth::id()) {
            return redirect('/')->withErrors(['action_denied' => 'The action was denied.']);
        }

        // Update user task.
        $task->name = $request->name;
        $task->complete = $request->complete == 'on' ? true : false;
        $task->important = $request->important == 'on' ? true : false;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect('task');
    }

    /**
     * Update 'complete' field.
     */
    public function mark($id)
    {
        $task = Task::find($id);
        $task->completed();

        return redirect()->back();
    }

    /**
     * Delete task record.
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        // Check if the logged user own this task.
        if ($task->user_id != Auth::id()) {
            return redirect('/')->withErrors(['action_denied' => 'The action was denied.']);
        }

        // Delete record.
        $task->delete();
        return redirect('task');
    }
}
