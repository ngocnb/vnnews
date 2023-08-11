<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    public $table = 'user_tags';

    public $fillable = [
        'user_id',
        'tag_id',
        'score'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'user_id' => 'required',
        'tag_id' => 'required',
        'score' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function tag(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Tag::class, 'tag_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
