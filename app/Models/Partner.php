<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name','website_url','logo','sort_order','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($q){ return $q->where('is_active', true); }
    public function scopeOrdered($q){ return $q->orderBy('sort_order')->orderBy('id'); }

    // লোগো src (external হলে 그대로, নচেৎ storage path)
    public function logoSrc(): string
    {
        if (!$this->logo) return 'https://via.placeholder.com/160x60?text=Logo';
        return str_starts_with($this->logo, 'http')
            ? $this->logo
            : asset('storage/'.$this->logo);
    }
}
