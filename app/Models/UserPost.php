<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    public $table = 'user_posts';

    public $fillable = [
        'user_id',
        'post_id',
        'total_post_score',
        'total_tag_score',
        'total_score',
        'post_title',
        'is_read',
        'reaction'
    ];

    protected $casts = [
        'post_title' => 'string',
        'is_read' => 'boolean',
        'reaction' => 'boolean'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'post_id' => 'required',
        'total_post_score' => 'required',
        'total_tag_score' => 'required',
        'total_score' => 'required',
        'post_title' => 'required|string|max:255',
        'is_read' => 'nullable|boolean',
        'reaction' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
