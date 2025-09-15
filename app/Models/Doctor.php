<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

      protected $fillable = [
    'name','email','password','phone',
    'full_name_en','full_name_bn','profile_photo','cover_banner',
    'medical_registration_number','specialization','current_designation',
    'institution_name','image_gallery','notification_preferences',
    'years_of_experience','educational_background','certifications_and_fellowships',
    'areas_of_interest','languages_spoken','location','short_bio','personal_website',
    'linkedin','researchgate','cv','social_links','membership_id','membership_level',
];


public function membershipLevel()
{
    return $this->belongsTo(MembershipLevel::class);
}

public function membershipAssignments()
{
    return $this->hasMany(MembershipAssignment::class);
}



public function membershipAssignment()
{
    return $this->hasOne(MembershipAssignment::class, 'doctor_id', 'id');
}

}
