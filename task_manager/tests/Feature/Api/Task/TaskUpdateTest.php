<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

test('it updates a task with valid parameters', function () {
    // Mock authenticated user
    $user = User::factory()->create();
    actingAs($user);

    // Create a task associated with the authenticated user
    $task = Task::factory()->create(['user_id' => $user->id]);

    // Define updated task data
    $updatedData = [
        'title' => 'Updated Title',
        'description' => 'Updated Description',
    ];

    // Send a PUT request to the update endpoint for the created task
    $response = put("/api/tasks/{$task->id}", $updatedData);

    // Assert that the response status code is 200 (OK)
    $response->assertStatus(200);

    // Assert that the response structure is as expected
    $response->assertJsonStructure([
        'status',
        'message',
        'task' => [
            'id',
            'title',
            'description',
            'status',
            'created_at',
            'updated_at',
        ],
    ]);

    // Assert that the response contains the success message
    $response->assertJson([
        'status' => 'success',
        'message' => 'Task details updated successfully.',
    ]);

    // Assert that the task has been updated with the new data
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => $updatedData['title'],
        'description' => $updatedData['description'],
    ]);
});

test('it updates the status of a task with valid parameters', function () {
    // Mock authenticated user
    $user = User::factory()->create();
    actingAs($user);

    // Create a task associated with the authenticated user
    $task = Task::factory()->create(['user_id' => $user->id]);

    // Define updated task data with status
    $updatedData = [
        'status' => true,
    ];

    // Send a PUT request to the update endpoint for the created task
    $response = put("/api/tasks/{$task->id}", $updatedData);

    // Assert that the response status code is 200 (OK)
    $response->assertStatus(200);

    // Assert that the response structure is as expected
    $response->assertJsonStructure([
        'status',
        'message',
        'task' => [
            'id',
            'title',
            'description',
            'status',
            'created_at',
            'updated_at',
        ],
    ]);

    // Assert that the response contains the success message
    $response->assertJson([
        'status' => 'success',
        'message' => 'Task details updated successfully.',
    ]);

    // Assert that the task status has been updated
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'status' => true,
    ]);
});

test('it returns an error with invalid parameters', function () {
    // Mock authenticated user
    $user = User::factory()->create();
    actingAs($user);

    // Create a task associated with the authenticated user
    $task = Task::factory()->create(['user_id' => $user->id]);

    // Define invalid task data
    $invalidData = [
        // Missing required parameters
    ];

    // Send a PUT request to the update endpoint with invalid data
    $response = put("/api/tasks/{$task->id}", $invalidData);

    // Assert that the response status code is 422 (Unprocessable Entity)
    $response->assertStatus(422);

    // Assert that the response structure is as expected
    $response->assertJsonStructure([
        'status',
        'message',
    ]);

    // Assert that the response contains the error message
    $response->assertJson([
        'status' => 'error',
        'message' => 'Invalid request. Please provide valid parameters.',
    ]);
})->uses(RefreshDatabase::class);
