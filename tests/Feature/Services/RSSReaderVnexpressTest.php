<?php

use App\Services\RSSReaderVnexpress;
use Illuminate\Container\Container;

use Vedmant\FeedReader\FeedReader;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;

use Pest\{TestBuilder, TestCase};

beforeEach(function () {
    // Create a new instance for each test
    $this->app = new Container();
    $this->feedReader = new FeedReader($this->app);
    $this->postRepo = new PostRepository($this->app);
    $this->tagRepo = new TagRepository($this->app);
    $this->service = new RSSReaderVnexpress($this->feedReader,$this->postRepo,$this->tagRepo);
});

test('it can get RSS content', function () {
    $rssReader = new RSSReaderVnexpress($this->feedReader,$this->postRepo,$this->tagRepo);

    $rssUrl = 'https://vnexpress.net/rss/the-gioi.rss';
    $result = $rssReader->getRSSContent($rssUrl);

    // Check
    expect($result)->toBeArray();
    expect(count($result))->toBeGreaterThan(0);
    expect($result[0])->toHaveKeys(['title', 'description', 'content', 'link', 'score_time']);
});

test('it can get content from a link', function () {
    $rssReader = new RSSReaderVnexpress($this->feedReader,$this->postRepo,$this->tagRepo);

    $articleUrl = 'https://vnexpress.net/my-dong-cua-su-quan-my-tai-haiti-sau-nhieu-tieng-sung-4639545.html';
    $result = $rssReader->getContentFromLink($articleUrl);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['content', 'tag']);
});

test('it can save content to the database', function () {

    $rssReader = new RSSReaderVnexpress($this->feedReader,$this->postRepo,$this->tagRepo);

    $data = ['title'=>'title', 'description'=>'description', 'content'=>'content', 'link'=>'link', 'score_time' => 500];
    $tags = ['Thế giới','Bóng đá'];
    $result = $rssReader->saveContentToDatabase($data, $tags);

    $post = $this->postRepo->findPostByLink($data['link']);

    expect($post->title)->toEqual($data['title']);
    expect($post->description)->toEqual($data['description']);
    expect($post->content)->toEqual($data['content']);
    expect($post->link)->toEqual($data['link']);
    expect($post->score_time)->toEqual($data['score_time']);

    $postTag = $post->tags();
    foreach ($tags as $tagName) {
        $tag = $this->tagRepo->findTagByName($tagName);
        expect($tag)->not->toBeNull();
    }
});

