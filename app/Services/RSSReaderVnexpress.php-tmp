<?php

namespace App\Services;

use Goutte\Client;
use Vedmant\FeedReader\FeedReader;

class RSSReaderVnexpress {

    protected $feedReader;

    public function __construct(FeedReader $feedReader) {
        $this->feedReader = $feedReader;
    }

    public function run() {
        $rss = config('rss.vnexpress');
        foreach ($rss as $key => $rssUrl) {
            $this->getRSSContent($key, $rssUrl);
        }
    }

    /**
     * This function get all items from RSS link.
     * For each item, it will get title, description and link.
     *
     * @param int|string $key
     * @param string $rssUrl
     * @return void
     */
    private function getRSSContent(int | string $key, string $rssUrl) {
        // read RSS link and get rss contents
        $feed = $this->feedReader->read($rssUrl);

        // foreach item in rss contents, get title, description and link
        // in each link, crawl the html content and filter the class fck_detail
        // save the content to database
        foreach ($feed->get_items() as $item) {
            $title       = $item->get_title();
            $description = $item->get_description();
            $link        = $item->get_link();
            $content     = $this->getContentFromLink($link);
            dd($content);
//            $this->saveContentToDatabase($key, $title, $description, $link, $content);
        }
    }

    /**
     * Get article content from link
     *
     * @param string|null $link
     * @return string
     */
    private function getContentFromLink( ? string $link) {
        $client  = new Client();
        $crawler = $client->request('GET', $link);

        // Find elements with class 'fck_detail' and extract their content
        $content = $crawler->filter('.fck_detail')->html();

        return $content;
    }
}
