<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\MembershipLevel;
use App\Http\Controllers\Controller;
use App\Models\MembershipAssignment;

class ReportController extends Controller
{
    public function revenue()
    {
      // শুধু মেম্বারশিপ নেওয়া ডাক্তারদের আনব
        $doctors = Doctor::with('membershipLevel')
            ->whereNotNull('membership_level_id')
            ->get();

        // টোটাল রেভিনিউ = sum of membership fee
        $totalRevenue = $doctors->sum(fn($doctor) => $doctor->membershipLevel->price);

        return view('reports.revenue', compact('doctors', 'totalRevenue'));
    }


    public function revenueByLevel()
    {
        // প্রতিটি লেভেল + ডাক্তারদের count
        $levels = MembershipLevel::withCount('doctors')->get();

        // প্রতিটি লেভেল থেকে revenue = price × doctors_count
        $levels->map(function ($level) {
            $level->revenue = $level->price * $level->doctors_count;
            return $level;
        });

        // মোট revenue
        $totalRevenue = $levels->sum('revenue');

        return view('reports.revenue_by_level', compact('levels', 'totalRevenue'));
    }

 public function basicReport()
    {
     $level = MembershipLevel::where('slug', 'basic')->firstOrFail();

    // শুধু সেই ডাক্তাররা যাদের membership_assignments আছে ওই লেভেলের
    $assignments = MembershipAssignment::with('doctor')
        ->where('membership_level_id', $level->id)
        ->get();

    $totalMembers = $assignments->count();
    $totalRevenue = $level->price * $totalMembers;

    return view('reports.basic_report', compact('level', 'assignments', 'totalMembers', 'totalRevenue'));

}

public function membershipReport($slug)
    {
        // লেভেল বের করি
        $level = MembershipLevel::where('slug', $slug)->firstOrFail();

        // ওই লেভেলের অ্যাসাইনমেন্ট + ডক্টর নিয়ে আসি
        $assignments = MembershipAssignment::with('doctor')
            ->where('membership_level_id', $level->id)
            ->get();

        // মেম্বার সংখ্যা এবং রেভিনিউ
        $totalMembers = $assignments->count();
        $totalRevenue = $level->price * $totalMembers;

        return view('reports.membership_report', compact('level', 'assignments', 'totalMembers', 'totalRevenue'));
    }



}
