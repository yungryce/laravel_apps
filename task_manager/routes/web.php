<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return redirect('tasks');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('all-tasks', [TaskController::class, 'allTasks'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.all');

Route::resource('tasks', TaskController::class)
    ->only(['index', 'show', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// Route::get('/tasks/{id}', function ($id) {
//     $tasks = Task::where('user_id', $id)->get();
//     return view('user_task', ['tasks' => $tasks]);
// })->name('tasks.show');

// typical example of a query. as used in tinker
// \App\Models\Task::select('user_id', 'title')->where('status', 'false')->limit(10)->get();

// require __DIR__.'/auth.php';
