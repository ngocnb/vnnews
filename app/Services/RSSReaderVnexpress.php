<?php

namespace App\Services;

use Goutte\Client;
use Vedmant\FeedReader\FeedReader;

use App\Repositories\PostRepository;
use App\Repositories\TagRepository;

use Symfony\Component\Panther\PantherTestCase;

class RSSReaderVnexpress {

    protected $feedReader;
    private PostRepository $postRepository;
    private TagRepository $tagRepository;

    public function __construct(FeedReader $feedReader,PostRepository $postRepo,TagRepository $tagRepo) {
        $this->feedReader = $feedReader;
        $this->postRepository = $postRepo;
        $this->tagRepository = $tagRepo;

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
            $data['score']  = $score_hot; 
            if(strpos($data['link'], 'video.vnexpress') === false){
                $d = $this->getContentFromLink($data['link']);
                $data['content']     = $d['content'];
                $tag       =  $d['tag'];
                $data['score_time'] = 500;
                $this->saveContentToDatabase($data,$tag);
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

        $data = [];
        // Find elements with class 'fck_detail' and extract their content
        $data['content'] = $crawler->filter('.fck_detail')->html();
        $data['tag'] = $crawler->filter('ul.breadcrumb > li > a')->each(function ($node) {
            if($this->tagRepository->findTagByName($node->text()) == null) $this->tagRepository->create(['name'=>$node->text()]);
            return $node->text();
        });

        return $data;
    }
    public function saveContentToDatabase($data,$tag){
        if($this->postRepository->findPostByLink($data['link']) == null){
            $posts = $this->postRepository->create($data);
            foreach ($tag as $key => $tag_name) {
                $tag_id = $this->tagRepository->findTagByName($tag_name)->id;
                $posts->tags()->attach($tag_id);
            }
        }
    }
}
