<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Testimonial extends Model
{
    protected $fillable = [
        'name','role','quote','rating','avatar_path','avatar_url','is_active','sort_order'
    ];

    // Scope: active + order
    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true)->orderBy('sort_order')->orderBy('id','desc');
    }
        protected $casts = [
        'is_active' => 'boolean', // 👈
    ];
    // Helper: final avatar url (uploads or external)
    public function getAvatarSrcAttribute(): ?string
    {
        if ($this->avatar_path) {
            // e.g. uploads/testimonials/abc.jpg (public/)
            return asset('storage/'.$this->avatar_path);
        }
        if ($this->avatar_url) return $this->avatar_url;
        return null;
    }
}
