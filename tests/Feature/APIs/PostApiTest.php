<?php

use App\Models\Post;

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\WithoutMiddleware::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

test('create post', function () {
    $post = Post::factory()->make()->toArray();

    $this->response = $this->json(
        'POST',
        '/api/posts', $post
    );

    $this->assertApiResponse($post);
})->group('api');

test('read post', function () {
    $post = Post::factory()->create();

    $this->response = $this->json(
        'GET',
        '/api/posts/' . $post->id
    );

    $this->assertApiResponse($post->toArray());
})->group('api');

test('update post', function () {
    $post       = Post::factory()->create();
    $editedPost = Post::factory()->make()->toArray();

    $this->response = $this->json(
        'PUT',
        '/api/posts/' . $post->id,
        $editedPost
    );

    $this->assertApiResponse($editedPost);
})->group('api');

test('delete post', function () {
    $post = Post::factory()->create();

    $this->response = $this->json(
        'DELETE',
        '/api/posts/' . $post->id
    );

    $this->assertApiSuccess();
    $this->response = $this->json(
        'GET',
        '/api/posts/' . $post->id
    );

    $this->response->assertStatus(404);
})->group('api');
