<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
   use HasFactory;


protected $fillable = [
'title','subtitle','badge_text','badge_icon','sort_order',
'btn1_text','btn1_url','btn2_text','btn2_url','image','is_active'
];


protected $casts = [
'is_active' => 'boolean',
'sort_order' => 'integer',
];
}
