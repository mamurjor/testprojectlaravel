<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipAssignment extends Model
{
    use HasFactory;
     protected $fillable = [
        'doctor_id','membership_level_id','assigned_by','starts_at','ends_at','notes'
    ];

    public function doctor(){ return $this->belongsTo(Doctor::class); }
    public function level(){ return $this->belongsTo(MembershipLevel::class,'membership_level_id'); }
    public function assigner(){ return $this->belongsTo(User::class,'assigned_by'); }

    public function membershipLevel()
    {
        return $this->belongsTo(MembershipLevel::class);
    }



    protected $dates = ['starts_at', 'ends_at'];

}
