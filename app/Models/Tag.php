<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    use HasFactory;
    public $table = 'tags';

    public $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public static array $rules = [
        'name'       => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
    ];

    public function postTags(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(\App\Models\PostTag::class, 'tag_id');
    }

    public function userTags(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(\App\Models\UserTag::class, 'tag_id');
    }
}
