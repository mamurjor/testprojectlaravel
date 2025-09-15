<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->orderBy('id','desc')->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:120',
            'role'        => 'nullable|string|max:120',
            'quote'       => 'required|string|max:2000',
            'rating'      => 'required|integer|min:1|max:5',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer|min:0',
            'avatar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // file
            'avatar_url'  => 'nullable|url|max:500',
        ]);

        // file upload (store to public disk)
        if ($request->hasFile('avatar')) {
        $aboutus = $request->file('avatar');
    $data['avatar'] = $aboutusName = 'avatar'.time().'.'.$aboutus->getClientOriginalExtension();
    $aboutus->move(public_path('uploads/avatar'), $aboutusName);


        }


        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success','Testimonial created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:120',
            'role'        => 'nullable|string|max:120',
            'quote'       => 'required|string|max:2000',
            'rating'      => 'required|integer|min:1|max:5',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer|min:0',
            'avatar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'avatar_url'  => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('avatar')) {
            $aboutus = $request->file('avatar');
    $data['avatar'] = $aboutusName = 'avatar'.time().'.'.$aboutus->getClientOriginalExtension();
    $aboutus->move(public_path('uploads/avatar'), $aboutusName);
        }
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success','Updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success','Deleted.');
    }
}
