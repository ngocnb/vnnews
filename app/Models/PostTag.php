<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    public $table = 'post_tags';

    public $fillable = [
        'post_id',
        'tag_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'post_id' => 'required',
        'tag_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
