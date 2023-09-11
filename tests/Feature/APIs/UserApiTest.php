<?php

use App\Models\User;

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\WithoutMiddleware::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

test('create user', function () {
    $user = User::factory()->make()->toArray();

    $this->response = $this->json(
        'POST',
        '/api/users', $user
    );

    $this->assertApiResponse($user);
})->group('api');

test('read user', function () {
    $user = User::factory()->create();

    $this->response = $this->json(
        'GET',
        '/api/users/' . $user->id
    );

    $this->assertApiResponse($user->toArray());
})->group('api');

test('update user', function () {
    $user       = User::factory()->create();
    $editedUser = User::factory()->make()->toArray();

    $this->response = $this->json(
        'PUT',
        '/api/users/' . $user->id,
        $editedUser
    );

    $this->assertApiResponse($editedUser);
})->group('api');

test('delete user', function () {
    $user = User::factory()->create();

    $this->response = $this->json(
        'DELETE',
        '/api/users/' . $user->id
    );

    $this->assertApiSuccess();
    $this->response = $this->json(
        'GET',
        '/api/users/' . $user->id
    );

    $this->response->assertStatus(404);
})->group('api');
