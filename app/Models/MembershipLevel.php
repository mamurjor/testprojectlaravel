<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipLevel extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','duration_days','price','is_lifetime'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
