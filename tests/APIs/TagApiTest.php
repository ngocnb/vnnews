<?php

use App\Models\Tag;

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\WithoutMiddleware::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

test('create tag', function () {
    $tag = Tag::factory()->make()->toArray();

    $this->response = $this->json(
        'POST',
        '/api/tags', $tag
    );

    $this->assertApiResponse($tag);
})->group('api');

test('read tag', function () {
    $tag = Tag::factory()->create();

    $this->response = $this->json(
        'GET',
        '/api/tags/' . $tag->id
    );

    $this->assertApiResponse($tag->toArray());
})->group('api');

test('update tag', function () {
    $tag       = Tag::factory()->create();
    $editedTag = Tag::factory()->make()->toArray();

    $this->response = $this->json(
        'PUT',
        '/api/tags/' . $tag->id,
        $editedTag
    );

    $this->assertApiResponse($editedTag);
})->group('api');

test('delete tag', function () {
    $tag = Tag::factory()->create();

    $this->response = $this->json(
        'DELETE',
        '/api/tags/' . $tag->id
    );

    $this->assertApiSuccess();
    $this->response = $this->json(
        'GET',
        '/api/tags/' . $tag->id
    );

    $this->response->assertStatus(404);
})->group('api');
