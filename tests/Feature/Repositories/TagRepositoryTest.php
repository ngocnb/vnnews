<?php

use App\Models\Tag;
use App\Repositories\TagRepository;
use Pest\{TestBuilder};
use Tests\TestCase;
use Illuminate\Support\Collection;

uses(\Tests\ApiTestTrait::class);
uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

beforeEach(function () {
    $this->tagRepo = app(TagRepository::class);
});

test('create tag', function () {
    $tag = Tag::factory()->make()->toArray();

    $createdTag = $this->tagRepo->create($tag);

    $createdTag = $createdTag->toArray();
    expect($createdTag)->toHaveKey('id');
    expect($createdTag['id'])->not->toBeNull('Created Tag must have id specified');
    expect(Tag::find($createdTag['id']))->not->toBeNull('Tag with given id must be in DB');
    $this->assertModelData($tag, $createdTag);
});

test('read tag', function () {
    $tag = Tag::factory()->create();

    $dbTag = $this->tagRepo->find($tag->id);

    $dbTag = $dbTag->toArray();
    $this->assertModelData($tag->toArray(), $dbTag);
});

test('update tag', function () {
    $tag = Tag::factory()->create();
    $fakeTag = Tag::factory()->make()->toArray();

    $updatedTag = $this->tagRepo->update($fakeTag, $tag->id);

    $this->assertModelData($fakeTag, $updatedTag->toArray());
    $dbTag = $this->tagRepo->find($tag->id);
    $this->assertModelData($fakeTag, $dbTag->toArray());
});

test('delete tag', function () {
    $tag = Tag::factory()->create();

    $resp = $this->tagRepo->delete($tag->id);

    expect($resp)->toBeTrue();
    expect(Tag::find($tag->id))->toBeNull('Tag should not exist in DB');
});


test('find tag by name', function () {
    $name = 'test';
    $tag = Tag::factory()->create(['name' => $name]);

    $foundTag = $this->tagRepo->findTagByName($name);

    expect($foundTag)->not->toBeNull();
    expect($foundTag->name)->toBe($name);
});

