<?php

namespace Tests\Repositories;

use App\Models\UserPost;
use App\Repositories\UserPostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserPostRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected UserPostRepository $userPostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userPostRepo = app(UserPostRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_post()
    {
        $userPost = UserPost::factory()->make()->toArray();

        $createdUserPost = $this->userPostRepo->create($userPost);

        $createdUserPost = $createdUserPost->toArray();
        $this->assertArrayHasKey('id', $createdUserPost);
        $this->assertNotNull($createdUserPost['id'], 'Created UserPost must have id specified');
        $this->assertNotNull(UserPost::find($createdUserPost['id']), 'UserPost with given id must be in DB');
        $this->assertModelData($userPost, $createdUserPost);
    }

    /**
     * @test read
     */
    public function test_read_user_post()
    {
        $userPost = UserPost::factory()->create();

        $dbUserPost = $this->userPostRepo->find($userPost->id);

        $dbUserPost = $dbUserPost->toArray();
        $this->assertModelData($userPost->toArray(), $dbUserPost);
    }

    /**
     * @test update
     */
    public function test_update_user_post()
    {
        $userPost = UserPost::factory()->create();
        $fakeUserPost = UserPost::factory()->make()->toArray();

        $updatedUserPost = $this->userPostRepo->update($fakeUserPost, $userPost->id);

        $this->assertModelData($fakeUserPost, $updatedUserPost->toArray());
        $dbUserPost = $this->userPostRepo->find($userPost->id);
        $this->assertModelData($fakeUserPost, $dbUserPost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_post()
    {
        $userPost = UserPost::factory()->create();

        $resp = $this->userPostRepo->delete($userPost->id);

        $this->assertTrue($resp);
        $this->assertNull(UserPost::find($userPost->id), 'UserPost should not exist in DB');
    }
}
