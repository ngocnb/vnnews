<?php

use App\Models\User;
use App\Repositories\UserRepository;

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

beforeEach(function () {
    $this->userRepo = app(UserRepository::class);
});

// test('create user', function () {
//     $user = User::factory()->make()->toArray();

//     $createdUser = $this->userRepo->create($user);

//     $createdUser = $createdUser->toArray();
//     expect($createdUser)->toHaveKey('id');
//     expect($createdUser['id'])->not->toBeNull('Created User must have id specified');
//     expect(User::find($createdUser['id']))->not->toBeNull('User with given id must be in DB');
//     $this->assertModelData($user, $createdUser);
// });

// test('read user', function () {
//     $user = User::factory()->create();

//     $dbUser = $this->userRepo->find($user->id);

//     $dbUser = $dbUser->toArray();
//     $this->assertModelData($user->toArray(), $dbUser);
// });

// test('update user', function () {
//     $user = User::factory()->create();
//     $fakeUser = User::factory()->make()->toArray();

//     $updatedUser = $this->userRepo->update($fakeUser, $user->id);

//     $this->assertModelData($fakeUser, $updatedUser->toArray());
//     $dbUser = $this->userRepo->find($user->id);
//     $this->assertModelData($fakeUser, $dbUser->toArray());
// });

// test('delete user', function () {
//     $user = User::factory()->create();

//     $resp = $this->userRepo->delete($user->id);

//     expect($resp)->toBeTrue();
//     expect(User::find($user->id))->toBeNull('User should not exist in DB');
// });
