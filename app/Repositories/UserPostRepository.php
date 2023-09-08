<?php

namespace App\Repositories;

use App\Models\UserPost;
use App\Repositories\BaseRepository;

class UserPostRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'post_id',
        'total_post_score',
        'total_tag_score',
        'total_score',
        'post_title',
        'is_read',
        'reaction'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserPost::class;
    }
}
