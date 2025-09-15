<?php
namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\MembershipLevel;
use App\Models\MembershipAssignment;
use App\Http\Requests\AssignMembershipRequest;
use Illuminate\Support\Facades\DB;

class DoctorMembershipController extends Controller
{
    public function update(AssignMembershipRequest $request, Doctor $doctor)
    {
        $level = MembershipLevel::findOrFail($request->membership_level_id);

        DB::transaction(function () use ($doctor, $level, $request) {
            // doctor টেবিলে current membership সেট করুন
            Doctor::where('id', $doctor->id)
      ->update(['membership_level_id' => $level->id]);
            //$doctor->update(['membership_level_id' => $level->id])->where('id',$doctor->id);

            // history টেবিলে লগ রাখুন
            $startsAt = now();
            $endsAt = $level->is_lifetime ? null :
                      ($level->duration_days ? now()->addDays($level->duration_days) : null);

            MembershipAssignment::create([
                'doctor_id' => $doctor->id,
                'membership_level_id' => $level->id,
                'assigned_by' => optional(auth()->user())->id,
                'starts_at' => $startsAt,
                'ends_at'   => $endsAt,
                'notes'     => $request->input('notes'),
            ]);
        });

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Membership assigned',
                'level' => $level->only('id','name','slug')
            ]);
        }

        return back()->with('success', 'Membership assigned to '.$doctor->name);
    }
}
