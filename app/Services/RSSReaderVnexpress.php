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
        foreach ($rss as $rssUrl) {
            $this->getRSSContent($rssUrl);
        }
    }

    /**
     * This function get all items from RSS link.
     * For each item, it will get title, description and link.
     *
     * @param string $rssUrl
     * @return array
     */
    public function getRSSContent(string $rssUrl) {
        // read RSS link and get rss contents
        $feed = $this->feedReader->read($rssUrl);
        $result = [];

        // foreach item in rss contents, get title, description and link
        // in each link, crawl the html content and filter the class fck_detail
        // save the content to database
        foreach ($feed->get_items() as $item) {
            $data = [];
            $data['title']       = $item->get_title();
            $data['description'] = $item->get_description();
            $data['link']        = $item->get_link();
            $data['content']     = $this->getContentFromLink($data['link']);
//            $this->saveContentToDatabase($key, $title, $description, $link, $content);
            $result[] = $data;
        }

        return $result;
    }

    /**
     * Get article content from link
     *
     * @param string|null $link
     * @return string
     */
    public function getContentFromLink( ? string $link) {
        $client  = new Client();
        $crawler = $client->request('GET', $link);

        // Find elements with class 'fck_detail' and extract their content
        $content = $crawler->filter('.fck_detail')->html();

        return $content;
    }
}
