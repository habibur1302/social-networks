<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Post;
use App\User;

class FollowPerson extends Model
{
    protected $table = 'follow_persons';
    protected $fillable = ['person_id', 'follower_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'person_id', 'id');
    }

    public function post() : HasMany
    {
        return $this->hasMany(Post::class, 'person_id', 'person_id');
    }
}
