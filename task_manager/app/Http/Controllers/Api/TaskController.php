<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $tasks = Task::where('user_id', $user->id)->latest()->get();
            
            return response()->json([
                'status' => 'success',
                'count' => count($tasks),
                'tasks' => $tasks,
            ], 200);
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error('Failed to fetch tasks: ' . $e->getMessage());
            
            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch tasks',
            ], 500);
        }
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $tasks = $request->user()->tasks();
    
        // Create the task and check if it was successfully created
        if ($tasks->create($validated)) {
            return response()->json([
                'status' =>'success',
                'message' => 'Task created successfully!',
                'task' => $tasks->latest()->get(),
                'count' => $tasks->count()
            ], 201);
        } else {
            // Handle the case where the task creation failed
            return response()->json([
                'status' =>'error',
                'message' => 'Failed to create task',
            ], 500); // Use appropriate HTTP status code for failure
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Check if the authenticated user owns the task
        if (Auth::user()->id !== $task->user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Return the task details
        return response()->json([
            'status' => 'success',
            'task' => $task,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|boolean',
        ]);
    
        if ($request->has('title') && $request->has('description')) {
            $task->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);
        } elseif ($request->has('status')) {
            $task->update([
                'status' => !$task->status,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid request. Please provide valid parameters.'
            ], 422);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Task details updated successfully.',
            'task' => $task->refresh(), // Refresh the task to get the latest data
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete task'
            ], 500);
        }
    }
    
}
