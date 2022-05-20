<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Post;
use App\Page;

class FollowPage extends Model
{
    protected $table = 'follow_pages';
    protected $fillable = ['page_id', 'follower_id'];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function post() : HasMany
    {
        return $this->hasMany(Post::class, 'page_id', 'page_id');
    }
}
