<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

      protected $fillable = [
        'key',
        'value'
    ];

     public static function getValue($key, $default = null)
    {
        return optional(self::where('key', $key)->first())->value ?? $default;
    }
}
