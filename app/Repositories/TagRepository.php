<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Tag::class;
    }

    public function findTagByName($name){
        return  $this->model->where('name',$name)->first();
    }
}
