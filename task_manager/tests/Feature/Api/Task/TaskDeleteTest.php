<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\delete;

it('deletes a task', function () {
    // Mock authenticated user
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create a task associated with the authenticated user
    $task = Task::factory()->create(['user_id' => $user->id]);

    // Send a DELETE request to the destroy endpoint for the created task
    $response = delete("/api/tasks/{$task->id}");

    // Assert that the response status code is 200 (OK)
    $response->assertStatus(200);

    // Assert that the response structure is as expected
    $response->assertJsonStructure([
        'status',
        'message',
    ]);

    // Assert that the response contains the success message
    $response->assertJson([
        'status' => 'success',
        'message' => 'Task deleted successfully',
    ]);

    // Assert that the task has been deleted from the database
    $this->assertDeleted($task);
})->uses(RefreshDatabase::class);
