<?php

use App\Models\UserPost;
use App\Repositories\UserPostRepository;

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

beforeEach(function () {
    $this->userPostRepo = app(UserPostRepository::class);
});

// test('create user post', function () {
//     $userPost = UserPost::factory()->make()->toArray();

//     $createdUserPost = $this->userPostRepo->create($userPost);

//     $createdUserPost = $createdUserPost->toArray();
//     expect($createdUserPost)->toHaveKey('id');
//     expect($createdUserPost['id'])->not->toBeNull('Created UserPost must have id specified');
//     expect(UserPost::find($createdUserPost['id']))->not->toBeNull('UserPost with given id must be in DB');
//     $this->assertModelData($userPost, $createdUserPost);
// });

// test('read user post', function () {
//     $userPost = UserPost::factory()->create();

//     $dbUserPost = $this->userPostRepo->find($userPost->id);

//     $dbUserPost = $dbUserPost->toArray();
//     $this->assertModelData($userPost->toArray(), $dbUserPost);
// });

// test('update user post', function () {
//     $userPost = UserPost::factory()->create();
//     $fakeUserPost = UserPost::factory()->make()->toArray();

//     $updatedUserPost = $this->userPostRepo->update($fakeUserPost, $userPost->id);

//     $this->assertModelData($fakeUserPost, $updatedUserPost->toArray());
//     $dbUserPost = $this->userPostRepo->find($userPost->id);
//     $this->assertModelData($fakeUserPost, $dbUserPost->toArray());
// });

// test('delete user post', function () {
//     $userPost = UserPost::factory()->create();

//     $resp = $this->userPostRepo->delete($userPost->id);

//     expect($resp)->toBeTrue();
//     expect(UserPost::find($userPost->id))->toBeNull('UserPost should not exist in DB');
// });
