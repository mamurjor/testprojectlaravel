<?php

namespace App\Models;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'event_date', 'end_date', 'max_registrations', 'is_free'];

    public function registerCount()
    {
        return $this->hasMany(Registration::class)->count(); // রেজিস্ট্রেশন সংখ্যা
    }
}
