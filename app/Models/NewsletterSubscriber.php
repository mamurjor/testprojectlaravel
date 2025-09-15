<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    use HasFactory;
     protected $fillable = ['email', 'verify_token', 'verified_at', 'unsubscribed_at'];
    protected $casts = [
        'verified_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];
}
