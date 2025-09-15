<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Page extends Model
{
    protected $fillable = [
        'title','slug','content','status','featured_image',
        'meta_title','meta_description','meta_keywords','published_at'
    ];

    // ✅ এইটা যোগ করুন
    protected $casts = [
        'published_at' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function($page){
            if (blank($page->slug) && filled($page->title)) {
                $base = \Illuminate\Support\Str::slug($page->title);
                $slug = $base; $i = 1;
                while (static::where('slug',$slug)->where('id','!=',$page->id)->exists()) {
                    $slug = $base.'-'.$i++;
                }
                $page->slug = $slug;
            }
        });
    }
}
