<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'parent_id', 'order', 'icon', 'class'];

    // Child relation
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    // Parent relation
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}
