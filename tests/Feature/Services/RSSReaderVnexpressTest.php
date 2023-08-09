<?php

use App\Services\RSSReaderVnexpress;
use Illuminate\Container\Container;
use Vedmant\FeedReader\FeedReader;

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
        expect($result[0])->toHaveKeys(['title', 'description', 'content', 'link']);
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
