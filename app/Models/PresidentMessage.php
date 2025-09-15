<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresidentMessage extends Model
{
    use HasFactory;
     protected $fillable = [
        'heading','person_name','person_title','avatar','quote','badge_text','read_more_url','is_active'
    ];
    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q){ return $q->where('is_active', true); }
}
