<?php

namespace Tests\Feature\Api\TaskController;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use function Pest\Laravel\withHeaders;
use App\Models\User;
use Tests\TestCase;

it('can create a task', function () {
    // Mock authenticated user
    $user = User::factory()->create();
    $this->actingAs($user);

    // Define task data
    $taskData = [
        'title' => 'Test Task',
        'description' => 'This is a test task',
    ];

    // Send POST request to store endpoint
    $response = $this->postJson('/api/tasks', $taskData);

    // Assert response status code is 201 (Created)
    $response->assertStatus(201);

    // Assert response structure
    $response->assertJsonStructure([
        'status',
        'message',
        'task',
        'count',
    ]);

    // Assert response content
    $response->assertJson([
        'status' => 'success',
        'message' => 'Task created successfully!',
        'task' => [
            [
                // Define expected task structure
                'title' => 'Test Task',
                'description' => 'This is a test task',
            ]
        ],
        'count' => 1,
    ]);
    
})->uses(RefreshDatabase::class);


it('returns an error if task creation fails', function () {
    // Mock authenticated user
    $user = User::factory()->create();
    $this->actingAs($user);

    // Send POST request to store endpoint with invalid data
    $response = $this->postJson('/api/tasks', []);

    // Assert response status code is 422 (Unprocessable Entity)
    $response->assertStatus(422);

    // Assert response structure
    $response->assertJsonStructure([
        'message',
        'errors' => [
            'title',
            'description',
        ],
    ]);
})->uses(RefreshDatabase::class);
