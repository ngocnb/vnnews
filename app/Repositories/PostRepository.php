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
        'is_new'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Post::class;
    }

    public function findPostByLink($link){
        return $this->model->where('link',$link)->first();
    }
}  
