<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'description',
        'link',
        'source',
        'content',
        'score_time',
        'score_click',
        'score_like',
        'score_hot',
        'is_new',
    ];

    private $source = ['vnexpress'];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Post::class;
    }

    public function findPostByLink($link)
    {
        return $this->model->where('link', $link)->first();
    }

    public function getTotalPages()
    {
        $totalPages = ceil($this->model->where('score_hot', '>', 0)->orderByRaw("created_at desc")->get()->count() / 10);
        return $totalPages;
    }

    public function getLatestNews($page)
    {
        $latest_news = $this->model->where('score_hot', '>', 0)->orderByRaw("created_at desc")->skip(($page - 1) * 10)->take(10)->get();
        return $latest_news;
    }

    public function getHotNews()
    {
        $hot_news = $this->model->orderByRaw("created_at desc")->take(10)->get();
        return $hot_news;
    }
}
