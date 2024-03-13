<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;


it('returns a task if it exists', function () {
    // Mock an authenticated user
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create a task associated with the authenticated user
    $task = Task::factory()->create(['user_id' => $user->id]);

    // Send a GET request to the show endpoint with the task ID
    $response = get("/api/tasks/{$task->id}");

    // Assert that the response status code is 200 (OK)
    $response->assertStatus(200);

    // Assert that the response structure is as expected
    $response->assertJsonStructure([
        'status',
        'task',
    ]);

    // Assert that the response contains the correct task data
    $response->assertJson([
        'status' => 'success',
        'task' => $task->toArray(),
    ]);
})->uses(RefreshDatabase::class);


// it('returns an error if the task does not exist', function () {
//     // Send a GET request to the show endpoint with a non-existent task ID
//     $response = get("/api/tasks/999");

//     // Assert that the response status code is 404 (Not Found)
//     $response->assertStatus(404);

//     // Assert that the response structure is as expected
//     $response->assertJsonStructure([
//         'status',
//         'message',
//     ]);

//     // Assert that the response contains the correct error message
//     $response->assertJson([
//         'status' => 'error',
//         'message' => 'Task not found',
//     ]);
// })->uses(RefreshDatabase::class);
