<?php

namespace Tests\Feature\Api\TaskController;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use function Pest\Laravel\withHeaders;
use App\Models\User;


it('can fetch all tasks for the authenticated user', function () {
    // Create a user and some tasks for testing
    $user = User::factory()->create();
    Task::factory()->count(3)->create(['user_id' => $user->id]);

    // Simulate an authenticated request to the index endpoint
    $response = withHeaders(['Authorization' => 'Bearer ' . $user->createToken('test-token')->plainTextToken])
        ->get('/api/tasks');

    // Assert that the response is successful (HTTP status code 200)
    $response->assertStatus(200);

    // Assert that the response contains the correct number of tasks
    $response->assertJsonCount(3, 'tasks');

    // Assert that the response structure is as expected
    $response->assertJsonStructure([
        'status',
        'count',
        'tasks' => [
            '*' => [
                'id',
                'title',
                'description',
                'created_at',
                'updated_at',
            ],
        ],
    ]);
})->uses(RefreshDatabase::class);

// it('returns an error response if fetching tasks fails', function () {
//     // Simulate an unauthenticated request to the index endpoint
//     $response = get('/api/tasks');

//     // Assert that the response indicates a server error (HTTP status code 500)
//     $response->assertStatus(500);

//     // Assert that the response structure is as expected
//     $response->assertJsonStructure([
//         'status',
//         'message',
//     ]);
// })->uses(RefreshDatabase::class);


