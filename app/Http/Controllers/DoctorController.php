<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Exports\DoctorsExport;
use App\Models\MembershipLevel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\DoctorStatusUpdated;
use Illuminate\Support\Facades\Mail;

class DoctorController extends Controller
{
 public function exportExcel()
    {
        return Excel::download(new DoctorsExport, 'doctors.xlsx');
    }

    public function exportPDF()
    {
       $doctors = Doctor::with('membershipLevel')->get();
        $pdf = Pdf::loadView('doctors.pdf', compact('doctors'));
        return $pdf->download('doctors.pdf');
    }

    public function index(Request $request)
{
    $search = $request->input('search');

$levels = MembershipLevel::all();
    $doctors = Doctor::with('membershipLevel')
    ->when($search, function ($query, $search) {
        $query->where('phone', 'like', "%{$search}%")
              ->orWhere('specialization', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%")
              ->orWhereHas('membershipLevel', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
    })
    ->paginate(10);

    return view('doctors.index', compact('doctors','levels'));
}

   public function listbyapproved(Request $request,$status)
{
    $search = $request->input('search');

$levels = MembershipLevel::all();
    $doctors = Doctor::with('membershipLevel')->where('status', $status)->paginate(10);

    return view('doctors.index', compact('doctors','levels'));
}

   public function listbypending(Request $request,$status)
{
    $search = $request->input('search');

    $levels = MembershipLevel::all();
    $doctors = Doctor::with('membershipLevel')->where('status', $status)->paginate(10);

    return view('doctors.index', compact('doctors','levels'));
}

public function show(Doctor $doctor)
{
    return view('doctors.show', compact('doctor'));
}

   public function listbycancelled(Request $request,$status)
{
    $search = $request->input('search');

    $levels = MembershipLevel::all();
    $doctors = Doctor::with('membershipLevel')->where('status', $status)->paginate(10);

    return view('doctors.index', compact('doctors','levels'));
}



public function updateStatus($id, $status)
{
    $doctor = Doctor::findOrFail($id);
    $doctor->status = $status;
    $doctor->save();

    // Send Email Notification
    Mail::to($doctor->email)->send(new DoctorStatusUpdated($doctor, $status));

    return redirect()->back()->with('success', "Doctor status updated to {$status}");
}
    /**
     * Show registration form
     */
    public function create()
    {
        return view('doctors.form', ['doctor' => new Doctor()]);
    }

    /**
     * Store new doctor
     */
  public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
             'phone' => 'required|string|max:20',
            'full_name_en' => 'nullable|string|max:255',
            'full_name_bn' => 'nullable|string|max:255',
            // Step 2
            'medical_registration_number' => 'nullable|string|max:100',
            'specialization' => 'nullable|string|max:255',
            'current_designation' => 'nullable|string|max:255',
            'institution_name' => 'nullable|string|max:255',
            'years_of_experience' => 'required|integer|min:0',
            'educational_background' => 'nullable|string',
            'certifications_and_fellowships' => 'nullable|string',
            'areas_of_interest' => 'nullable|string',
            'languages_spoken' => 'nullable|string|max:255',
            // Step 3
            'short_bio' => 'nullable|string',
            'personal_website' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'researchgate' => 'nullable|url',
            'cv' => 'nullable|file|mimes:pdf,doc,docx',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'cover_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'social_links' => 'nullable|string',
            'membership_id' => 'nullable|string|max:100',
            'membership_level' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('cv')) {
            $aboutus = $request->file('cv');
       $validated['cv'] =   $aboutusName = 'cv_'.time().'.'.$aboutus->getClientOriginalExtension();
        $aboutus->move(public_path('uploads/doctors/cv'), $aboutusName);
        }

        if ($request->hasFile('profile_photo')) {
            $aboutus = $request->file('profile_photo');
            $validated['profile_photo'] =  $aboutusName = 'profile_photo_'.time().'.'.$aboutus->getClientOriginalExtension();
            $aboutus->move(public_path('uploads/doctors/profile_photo'), $aboutusName);
        }
        if ($request->hasFile('cover_banner')) {
              $aboutus = $request->file('cover_banner');
            $validated['cover_banner'] =  $aboutusName = 'cover_banner_'.time().'.'.$aboutus->getClientOriginalExtension();
            $aboutus->move(public_path('uploads/doctors/cover'), $aboutusName);


        }


        Doctor::create($validated);
 return redirect()->route('doctor.index')->with('success', 'Doctor Registered Successfully.');

    }

    /**
     * Show edit form
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.form', compact('doctor'));
    }

    /**
     * Update doctor info
     */
  // Doctor Update
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email',Rule::unique('doctors')->ignore($doctor->id)],

            'phone' => 'required|string|max:20',
            'full_name_en' => 'required|string|max:255',
            'full_name_bn' => 'required|string|max:255',
            // Step 2
            'medical_registration_number' => 'required|string|max:100',
            'specialization' => 'nullable|string|max:255',
            'current_designation' => 'nullable|string|max:255',
            'institution_name' => 'required|string|max:255',
            'years_of_experience' => 'required|integer|min:0',
            'educational_background' => 'nullable|string',
            'certifications_and_fellowships' => 'nullable|string',
            'areas_of_interest' => 'nullable|string',
            'languages_spoken' => 'nullable|string|max:255',
            // Step 3
            'short_bio' => 'required|string',
            'personal_website' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'researchgate' => 'nullable|url',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'social_links' => 'nullable|string',
            'membership_id' => 'nullable|string|max:100',
            'membership_level' => 'nullable|string|max:100',
        ]);

     if ($request->hasFile('cv')) {
            $aboutus = $request->file('cv');
       $validated['cv'] =   $aboutusName = 'cv_'.time().'.'.$aboutus->getClientOriginalExtension();
        $aboutus->move(public_path('uploads/doctors/cv'), $aboutusName);
        }

        if ($request->hasFile('profile_photo')) {
            $aboutus = $request->file('profile_photo');
            $validated['profile_photo'] =  $aboutusName = 'profile_photo_'.time().'.'.$aboutus->getClientOriginalExtension();
            $aboutus->move(public_path('uploads/doctors/profile_photo'), $aboutusName);
        }
        if ($request->hasFile('cover_banner')) {
              $aboutus = $request->file('cover_banner');
            $validated['cover_banner'] =  $aboutusName = 'cover_banner_'.time().'.'.$aboutus->getClientOriginalExtension();
            $aboutus->move(public_path('uploads/doctors/cover'), $aboutusName);


        }



        $doctor->update($validated);

       return redirect()->route('doctor.index')->with('success', 'Doctor Update successfully.');
    }

    /**
     * Validation rules
     */
    private function validateForm(Request $request, $id = null)
    {
        return $request->validate([
            'name' => 'nullable',
            'email' => 'required',
            'password' => $id ? 'nullable|min:6' : 'required|min:6',
            'phone' => 'required',
            'full_name_en' => 'nullable|string|max:255',
            'full_name_bn' => 'nullable|string|max:255',
            'medical_registration_number' => 'nullable|string|max:100',
            'specialization' => 'nullable|string|max:255',
            'current_designation' => 'nullable|string|max:255',
            'institution_name' => 'nullable|string|max:255',
            'image_gallery' => 'nullable|string', // could be JSON
            'notification_preferences' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
            'educational_background' => 'nullable|string',
            'certifications_and_fellowships' => 'nullable|string',
            'areas_of_interest' => 'nullable|string',
            'languages_spoken' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'short_bio' => 'nullable|string|max:1000',
            'personal_website' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'researchgate' => 'nullable|url',
            'social_links' => 'nullable|string', // JSON or comma separated
            'membership_id' => 'nullable|string|max:100',
            'membership_level' => 'nullable|string|max:100',
            // File fields
            'profile_photo' => $id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'cover_banner' => 'nullable|image|max:4096',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);
    }

    /**
     * Handle file uploads
     */
    private function handleUploads(Request $request, $data)
    {
        foreach ([
            'profile_photo' => 'profile_photos',
            'cover_banner' => 'cover_banners',
            'cv' => 'cv_files'
        ] as $field => $folder) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store($folder, 'public');
            }
        }
        return $data;
    }


      // DELETE /doctor/{doctor}
    public function destroy(Doctor $doctor)
    {
        // প্রোফাইল ছবি ফাইল থাকলে মুছুন (আপনার স্টোরেজ স্ট্রাকচার অনুযায়ী এডজাস্ট করুন)
        if ($doctor->profile_photo) {
            $path = public_path('uploads/doctors/profile_photo/' . $doctor->profile_photo);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $doctor->delete();
        return redirect()->route('doctor.index')->with('success', 'Doctor deleted successfully.');
    }
}
