<?php

use App\Models\Post;
use App\Repositories\PostRepository;

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
        'link' => rand(),
        'score_time' => 500,
    ]);

    $foundPost = $this->postRepo->findPostByLink($post->link);

    expect($foundPost->id)->toBe($post->id);
    expect($foundPost->title)->toBe('title');
    expect($foundPost->description)->toBe('description');
    expect($foundPost->content)->toBe('content');
    expect($foundPost->link)->toBe($post->link);
    expect($foundPost->score_time)->toBe(500);
});

test('it calculates total pages correctly', function () {
    $posts = Post::factory()->count(65)->create();
    $read_counts = 7;

    $totalPages = $this->postRepo->getTotalPages($read_counts);

    $expectedTotalPages = ceil(58 / 10);
    expect($totalPages)->toBe($expectedTotalPages);
});

test('it get the latest news by page', function () {
    $posts = Post::factory()->count(25)->create();
    $read_news_id = [$posts[0]->id, $posts[1]->id];
    $page = 1;

    // Act
    $latestNews = $this->postRepo->getLatestNews($page, $read_news_id);

    // Assert
    expect($latestNews)->toBeInstanceOf(Collection::class);
    expect($latestNews->count())->toBe(10);
    foreach ($latestNews as $post) {
        expect(in_array($post->id, $read_news_id))->toBeFalse();
    }
});

test('it get the top 10 hot news', function () {
    $posts = Post::factory()->count(25)->create(['score_hot' => 1]);
    $read_news_id = [$posts[0]->id, $posts[1]->id];
    // Act
    $hotNews = $this->postRepo->getHotNews($read_news_id);

    // Assert
    expect($hotNews)->toBeInstanceOf(Collection::class);
    expect($hotNews->count())->toBe(10);
    foreach ($hotNews as $post) {
        expect(in_array($post->id, $read_news_id))->toBeFalse();
    }
});


test('it get news by id', function () {
    $post = Post::factory()->create();
    $tag_name = "Thế giới";
    $id = $post->id;
    $tag_id = $this->tagRepository->findTagByName($tag_name)->id;
    $post->tags()->attach($tag_id);
    // Act
    $news = $this->postRepo->getNewsById($id);

    // Assert
    expect($news)->toBeInstanceOf(Collection::class);
    expect($news)->toBe($post);
});

test('it get read_news by read_news_id', function () {
    $post = Post::factory()->create();
    $read_news_id = [$post->id];
    // Act
    $news = $this->postRepo->getReadNews($read_news_id);

    // Assert
    expect($news)->toBeInstanceOf(Collection::class);
    expect($news)->toBe($post);
});
