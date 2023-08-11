<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class User extends Model
{
    public $table = 'users';

    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'user_tags_score');
    }

    public function posts(): MorphToMany
    {
        return $this->morphToMany(Post::class, 'post_interactions');
    }

    public function userPosts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\UserPost::class, 'user_id');
    }

    public function userTags(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\UserTag::class, 'user_id');
    }
}
