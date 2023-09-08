<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model {
    use HasFactory;
    public $table = 'post_tags';

    public $fillable = [
        'post_id',
        'tag_id',
    ];

    protected $casts = [

    ];

    public static array $rules = [
        'post_id'    => 'required',
        'tag_id'     => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
    ];

    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }

    public function tag(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\Tag::class, 'tag_id');
    }
}
