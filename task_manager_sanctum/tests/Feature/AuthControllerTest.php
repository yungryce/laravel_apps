<?php

namespace Tests\Feature;

use App\Models\User;
use function Pest\Laravel\post;
use Illuminate\Foundation\Testing\RefreshDatabase;


it('can register a new user', function () {
    // $userData = User::factory()->make()->toArray();
    // $userData['password'] = 'password';
    // $userData['password_confirmation'] = 'password';

    $user = User::factory()->create();

    // Prepare the registration data using the retrieved user's attributes
    $userData = [
        'name' => $user->name,
        'email' => uniqid('test').'@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    // Send a POST request to the registration endpoint
    $response = post('/api/register', $userData);

    // Assert that the registration was successful (HTTP status code 201)
    $response->assertStatus(201);

    // Assert that the user exists in the database
    $this->assertDatabaseHas('users', [
        'email' => $userData['email'],
    ]);
})->uses(RefreshDatabase::class);


it('can authenticate a user', function () {
    // Retrieve a random user from the database using the User model
    $user = User::inRandomOrder()->first();

    // Prepare login data
    $loginData = [
        'email' => $user->email,
        'password' => 'password',
    ];

    // Send a POST request to the login endpoint
    $response = post('/api/login', $loginData);

    // Assert that the login was successful (HTTP status code 200)
    $response->assertStatus(200);

    // Assert that the response contains the user's token
    $responseData = $response->json();
    $this->assertNotNull($responseData['token']);
});

it('can log out a user', function () {
    // Retrieve a random user from the database using the User model
    $user = User::inRandomOrder()->first();

    // Create a token for the user
    $token = $user->createToken('api-token')->plainTextToken;

    // Send a POST request to the logout endpoint with the token in the headers
    $response = post('/api/logout', [], ['Authorization' => 'Bearer ' . $token]);

    // Assert that the logout was successful (HTTP status code 200)
    $response->assertStatus(200);

    // Assert that the token has been deleted
    $this->assertEmpty($user->tokens);
});
