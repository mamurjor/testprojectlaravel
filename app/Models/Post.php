<?php

namespace App\Models;


use App\Models\User;
use App\Models\Comment;
use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
use HasFactory, SoftDeletes,GeneratesSlug;


protected $fillable = [
'user_id','title','slug','excerpt','featured_image','content','status','published_at'
];


protected $casts = [
'published_at' => 'datetime',
];

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function categories()
{
return $this->belongsToMany(Category::class);
}


public function author()
{
return $this->belongsTo(User::class, 'user_id');
}


public function scopePublished(Builder $query): Builder
{
return $query->where('status', 'published')
->where(function($q){
$q->whereNull('published_at')->orWhere('published_at', '<=', now());
});
}


public function getRouteKeyName()
{
return 'slug';
}
}
