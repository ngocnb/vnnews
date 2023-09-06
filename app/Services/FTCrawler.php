<?php

namespace App\Services;

use Goutte\Client;

class FTCrawler {

    public function getArticleContent(string $link) {
        $client  = new Client();
        $crawler = $client->request('GET', $link);
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 6.1; rv:60.0) Gecko/20100101 Firefox/60.0');
        $client->setServerParameter('HTTP_REFERER', 'https://www.google.com');

        // Find elements with class 'fck_detail' and extract their content
        $content = $crawler->filter('.fck_detail')->html();
        return $content;
    }
}
