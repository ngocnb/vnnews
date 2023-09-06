<?php

use App\Services\RSSReaderVnexpress;
use Illuminate\Container\Container;
use Vedmant\FeedReader\FeedReader;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostTag;

beforeEach(function () {
    // Create a new instance for each test
    $this->app = new Container();
    $this->feedReader = new FeedReader($this->app);
    $this->service = new RSSReaderVnexpress($this->feedReader);
});

describe('getRSSContent', function () {
    it('should get content of a vnexpress rss', function () {
        // Arrange
        $rssUrl = 'https://vnexpress.net/rss/tin-moi-nhat.rss';

        // Act
        $result = $this->service->getRSSContent($rssUrl);

        // Assert
        expect($result)->toBeArray();
        // expect result count to greater than 0
        expect(count($result))->toBeGreaterThan(0);
        // expect result item to have title, description, content and link
        expect($result[0])->toHaveKeys(['title', 'description', 'content', 'link','tag']);
    });
});

describe('getContentFromLink', function () {
    it('should get content of a vnexpress article from url', function () {
        // Arrange
        $articleUrl = 'https://vnexpress.net/my-dong-cua-su-quan-my-tai-haiti-sau-nhieu-tieng-sung-4639545.html';

        // Act
        $result = $this->service->getContentFromLink($articleUrl);

        // Assert
        expect($result)->toBeString();
        // expect result should not be empty
        expect($result)->not->toBeEmpty();
    });
});

describe('saveContentToDatabase', function () {
    it('Lưu posts', function () {

         // Arrange
         $title = "Test Title";
         $description = "Test Description";
         $link = "https://example.com/test";
         $content = "Test Content";
         $tag = ["Thế giới", "Thời sự"];
         $score_hot = 100;
 
         // Act
         $this->service->saveContentToDatabase($title, $description, $link, $content, $tag, $score_hot);
 
         // Assert
         $post = Post::where('link', $link)->first();
         $this->assertInstanceOf(Post::class, $post);
         $this->assertEquals($title, $post->title);
         $this->assertEquals($description, $post->description);
         $this->assertEquals($link, $post->link);
         $this->assertEquals($content, $post->content);
         $this->assertEquals($score_hot, $post->score_hot);
 
         // Check if tags are associated with the post
         foreach ($tag as $tagName) {
             $tagModel = Tag::where('name', $tagName)->first();
             $this->assertNotNull($tagModel);
 
             $postTag = PostTag::where('post_id', $post->id)
                 ->where('tag_id', $tagModel->id)
                 ->first();
 
             $this->assertInstanceOf(PostTag::class, $postTag);
         }

    });
});

describe('getTagFromLink', function () {
    it('Lấy tag và lưu những tag chưa có vào db', function () {

         // Arrange
         $link = "https://vnexpress.net/viet-nam-guam-cho-tin-dai-thang-o-vong-loai-u23-chau-a-4649893.html";
         $tag = ["Thể thao", "Bóng đá", "Trong nước"];
         // Act
         $this->service->getTagFromLink($link);
 
         // Assert
 
         // Check if tags are associated with the post
         foreach ($tag as $tagName) {
             $tagModel = Tag::where('name', $tagName)->first();
             $this->assertNotNull($tagModel);
         }

    });
});