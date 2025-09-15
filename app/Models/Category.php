<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\GeneratesSlug;

class Category extends Model
{
use HasFactory, SoftDeletes,GeneratesSlug;


protected $fillable = ['name', 'slug', 'description', 'parent_id'];


public function posts()
{
return $this->belongsToMany(Post::class);
}
  public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


// Route model binding by slug
public function getRouteKeyName()
{
return 'slug';
}
}
