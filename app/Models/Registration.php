<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
       use HasFactory;

    protected $fillable = ['event_id', 'name', 'email'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
