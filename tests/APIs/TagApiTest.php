<?php

namespace Tests\APIs;

use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

class TagApiTest extends TestCase {
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     * @group api
     */
    public function test_create_tag() {
        $tag = Tag::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tags', $tag
        );

        $this->assertApiResponse($tag);
    }

    /**
     * @test
     * @group api
     */
    public function test_read_tag() {
        $tag = Tag::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tags/' . $tag->id
        );

        $this->assertApiResponse($tag->toArray());
    }

    /**
     * @test
     * @group api
     */
    public function test_update_tag() {
        $tag       = Tag::factory()->create();
        $editedTag = Tag::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tags/' . $tag->id,
            $editedTag
        );

        $this->assertApiResponse($editedTag);
    }

    /**
     * @test
     * @group api
     */
    public function test_delete_tag() {
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
    }
}
