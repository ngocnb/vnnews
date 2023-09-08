<?php

use Illuminate\Container\Container;

use App\Models\Post;
use App\Repositories\PostRepository;
use Pest\{TestBuilder, TestCase};

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

beforeEach(function () {
    $this->app = new Container();
    $this->service = new PostRepository();
});

// test('create post', function () {
//     $post = Post::factory()->make()->toArray();

//     $createdPost = $this->postRepo->create($post);

//     $createdPost = $createdPost->toArray();
//     expect($createdPost)->toHaveKey('id');
//     expect($createdPost['id'])->not->toBeNull('Created Post must have id specified');
//     expect(Post::find($createdPost['id']))->not->toBeNull('Post with given id must be in DB');
//     $this->assertModelData($post, $createdPost);
// });

// test('read post', function () {
//     $post = Post::factory()->create();

//     $dbPost = $this->postRepo->find($post->id);

//     $dbPost = $dbPost->toArray();
//     $this->assertModelData($post->toArray(), $dbPost);
// });

// test('update post', function () {
//     $post = Post::factory()->create();
//     $fakePost = Post::factory()->make()->toArray();

//     $updatedPost = $this->postRepo->update($fakePost, $post->id);

//     $this->assertModelData($fakePost, $updatedPost->toArray());
//     $dbPost = $this->postRepo->find($post->id);
//     $this->assertModelData($fakePost, $dbPost->toArray());
// });

// test('delete post', function () {
//     $post = Post::factory()->create();

//     $resp = $this->postRepo->delete($post->id);

//     expect($resp)->toBeTrue();
//     expect(Post::find($post->id))->toBeNull('Post should not exist in DB');
// });

it('finds a post by link', function () {
    $postData = [
        'title' => 'title',
        'description' => 'description',
        'content' => 'content',
        'link' => 'link',
        'score_time' => 500,
    ];

    $post = Post::factory()->create($postData);

    $foundPost = $this->postRepo->findPostByLink('link');

    expect($foundPost->toArray())->toBe($postData);
});
