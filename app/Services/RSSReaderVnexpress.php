<?php

namespace App\Services;

use Goutte\Client;
use Vedmant\FeedReader\FeedReader;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostTag;

use Symfony\Component\Panther\PantherTestCase;

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
        $score_hot = 0;
        // check hot news
        if($rssUrl == 'https://vnexpress.net/rss/tin-noi-bat.rss') $score_hot = 200;
        // foreach item in rss contents, get title, description and link
        // in each link, crawl the html content and filter the class fck_detail
        // save the content to database
        foreach ($feed->get_items() as $item) {
            $data = [];
            $data['title']       = $item->get_title();
            $data['description'] = $item->get_description();
            $data['link']        = $item->get_link();
            if(strpos($data['link'], 'video.vnexpress') === false && strlen($data['description']) <= 500 ){
                $data['content']     = $this->getContentFromLink($data['link']);
                $data['tag']        = $this->getTagFromLink($data['link']);
                $this->saveContentToDatabase($data['title'], $data['description'], $data['link'], $data['content'], $data['tag'],$score_hot);
                $result[] = $data;
            }
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
        dump($link);

        // Find elements with class 'fck_detail' and extract their content
        $content = $crawler->filter('.fck_detail')->html();
        return $content;
    }

    public function saveContentToDatabase($title,$description, $link,$content = null,$tag,$score_hot){
        if(Post::where('link',$link)->get()->toArray() == []){
            $posts = Post::create(['title'=>$title,'description'=>$description,'link'=>$link,'content'=>$content,'score_time'=>500,'score_hot' => $score_hot]);
            foreach ($tag as $key => $value) {
                $post_id = $posts->id;
                $tag_id = Tag::where('name',$value)->first()->id;
                PostTag::create(['post_id'=>$post_id,'tag_id'=>$tag_id]);
            }
        }
    }

    public function getTagFromLink(? string $link){
        $client  = new Client();
        $crawler = $client->request('GET', $link);
        $tags = [];
        $tags = $crawler->filter('ul.breadcrumb > li > a')->each(function ($node) {
            if(Tag::where('name',$node->text())->get()->toArray() == []) Tag::create(['name'=>$node->text()]);
            return $node->text();
        });
        return $tags;
    }
}
