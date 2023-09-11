<?php

use App\Models\Post;
use App\Repositories\PostRepository;
use Pest\{TestBuilder};
use Tests\TestCase;
use Illuminate\Support\Collection;

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

beforeEach(function () {
    $this->postRepo = app(PostRepository::class);
});

test('create post', function () {
    $post = Post::factory()->make()->toArray();

    $createdPost = $this->postRepo->create($post);

    $createdPost = $createdPost->toArray();
    expect($createdPost)->toHaveKey('id');
    expect($createdPost['id'])->not->toBeNull('Created Post must have id specified');
    expect(Post::find($createdPost['id']))->not->toBeNull('Post with given id must be in DB');
    $this->assertModelData($post, $createdPost);
});

test('read post', function () {
    $post = Post::factory()->create();

    $dbPost = $this->postRepo->find($post->id);

    $dbPost = $dbPost->toArray();
    $this->assertModelData($post->toArray(), $dbPost);
});

test('update post', function () {
    $post = Post::factory()->create();
    $fakePost = Post::factory()->make()->toArray();

    $updatedPost = $this->postRepo->update($fakePost, $post->id);

    $this->assertModelData($fakePost, $updatedPost->toArray());
    $dbPost = $this->postRepo->find($post->id);
    $this->assertModelData($fakePost, $dbPost->toArray());
});

test('delete post', function () {
    $post = Post::factory()->create();

    $resp = $this->postRepo->delete($post->id);

    expect($resp)->toBeTrue();
    expect(Post::find($post->id))->toBeNull('Post should not exist in DB');
});

test('it finds a post by link', function () {

    $post = Post::factory()->create([
        'title' => 'title',
        'description' => 'description',
        'content' => 'content',
        'link' => 'link',
        'score_time' => 500,
    ]);

    $foundPost = $this->postRepo->findPostByLink('link');

    expect($foundPost->id)->toBe($post->id);
    expect($foundPost->title)->toBe('title');
    expect($foundPost->description)->toBe('description');
    expect($foundPost->content)->toBe('content');
    expect($foundPost->link)->toBe('link');
    expect($foundPost->score_time)->toBe(500);
});

test('it calculates total pages correctly', function () {
    $posts = Post::factory()->count(15)->create(['score_hot' => 1]);

    $totalPages = $this->postRepo->getTotalPages();
    
    $expectedTotalPages = ceil(15 / 10);
    expect($totalPages)->toBe($expectedTotalPages);
});

test('it get the latest news by page', function () {
    $posts = Post::factory()->count(25)->create();
    $page = 2; 

    // Act
    $latestNews = $this->postRepo->getLatestNews($page);

    // Assert
    expect($latestNews)->toBeInstanceOf(Collection::class);
    expect($latestNews->count())->toBe(10); 
    foreach ($latestNews as $post) {
    expect($post->tag_names)->toBeArray();
}});

test('it get the top 10 hot news', function () {
    $posts = Post::factory()->count(25)->create(['score_hot' => 1]);
    
    // Act
    $hotNews = $this->postRepo->getHotNews();

    // Assert
    expect($hotNews)->toBeInstanceOf(Collection::class);
    expect($hotNews->count())->toBe(10); 
    foreach ($hotNews as $post) {
    expect($post->tag_names)->toBeArray();
    }
});