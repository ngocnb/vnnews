<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model {
    use HasFactory;
    const SOURCE_VNEXPRESS = 0;
    public $table          = 'posts';

    public $fillable = [
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

    protected $casts = [
        'title'       => 'string',
        'description' => 'string',
        'link'        => 'string',
        'source'      => 'boolean',
        'content'     => 'string',
        'is_new'      => 'boolean',
    ];

    public static array $rules = [
        'title'       => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'link'        => 'required|string|max:1000',
        'source'      => 'required|boolean',
        'content'     => 'nullable|string|max:65535',
        'score_time'  => 'nullable',
        'score_click' => 'nullable',
        'score_like'  => 'nullable',
        'score_hot'   => 'nullable',
        'is_new'      => 'required|boolean',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
    ];

    public function tags(): MorphToMany {
        return $this->morphToMany(Tag::class, 'post_has_tags');
    }

    public function userPosts(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(\App\Models\UserPost::class, 'post_id');
    }

    public function postTags(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(\App\Models\PostTag::class, 'post_id');
    }
}
