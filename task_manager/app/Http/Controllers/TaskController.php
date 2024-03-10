<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function allTasks()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->latest()->paginate(5);
        
        return view('tasks.all', compact('tasks'));
    }
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->latest()->where('status', false)->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $request->user()->tasks()->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = [];

        if ($request->has('title') && $request->has('description')) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
            $task->update($validated);
        } elseif ($request->has('status')) {
            $task->status = !$task->status;
            $task->save();
        } else {
            return back()->withErrors(['error' => 'Invalid request. Please provide valid parameters.']);
        }

        return redirect()->route('tasks.index')->with('success', 'Task details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
