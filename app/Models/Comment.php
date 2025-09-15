<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id','parent_id','name','email','website','body','status','ip','user_agent'
    ];

    public function post()     { return $this->belongsTo(Post::class); }
    public function parent()   { return $this->belongsTo(Comment::class, 'parent_id'); }
    public function children() { return $this->hasMany(Comment::class, 'parent_id'); }

    // Only approved
    public function scopeApproved(Builder $q) { return $q->where('status','approved'); }

}
