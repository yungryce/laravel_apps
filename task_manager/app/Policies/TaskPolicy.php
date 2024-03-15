<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        if ($user->id === $task->user_id && ($user->role->name === 'admin' || $user->role->name === 'manager')) {
            // Check if the user owns the task or if any privileged user is assigned
                return true;
        }

        // Check if the user owns the task
        if ($user->id === $task->user_id) {
            // Check if the task does not have a privileged user assigned
            if (!$task->users()->whereHas('role', function ($query) {
                $query->where('name', 'admin')->orWhere('name', 'manager');
            })->exists()) {
                // Allow the task owner to update all fields 
                    return true;
            }
            elseif (!$task->title && !$task->description && $task->status !== 'start' && $task->status !== 'close') {
                return true;
            }
        }

        // Deny access by default
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        if ($user->id === $task->user_id && ($user->role->name === 'admin' || $user->role->name === 'manager')) {
            // Check if the user owns the task or if any privileged user is assigned
                return true;
        }
                // Check if the user owns the task
        if ($user->id === $task->user_id) {
            // Check if the task does not have a privileged user assigned
            if (!$task->users()->whereHas('role', function ($query) {
                $query->where('name', 'admin')->orWhere('name', 'manager');
            })->exists()) {
                // Allow the task owner to update all fields 
                    return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        //
    }
}
