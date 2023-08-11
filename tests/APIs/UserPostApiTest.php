<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserPost;

class UserPostApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_post()
    {
        $userPost = UserPost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user-posts', $userPost
        );

        $this->assertApiResponse($userPost);
    }

    /**
     * @test
     */
    public function test_read_user_post()
    {
        $userPost = UserPost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user-posts/'.$userPost->id
        );

        $this->assertApiResponse($userPost->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_post()
    {
        $userPost = UserPost::factory()->create();
        $editedUserPost = UserPost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user-posts/'.$userPost->id,
            $editedUserPost
        );

        $this->assertApiResponse($editedUserPost);
    }

    /**
     * @test
     */
    public function test_delete_user_post()
    {
        $userPost = UserPost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user-posts/'.$userPost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user-posts/'.$userPost->id
        );

        $this->response->assertStatus(404);
    }
}
