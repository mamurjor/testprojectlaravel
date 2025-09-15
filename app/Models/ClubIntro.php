<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubIntro extends Model
{
    protected $fillable = [
        'title','body','bullet_points',
        'btn1_text','btn1_url','btn2_text','btn2_url','is_active',
    ];
    protected $casts = [
        'bullet_points' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($q){ return $q->where('is_active', true); }
}

