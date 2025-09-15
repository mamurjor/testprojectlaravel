<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Http\Requests\HeroSectionRequest;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroes = HeroSection::orderBy('sort_order')->latest('id')->paginate(12);
        return view('hero_sections.index', compact('heroes'));
    }

    public function create()
    {
        return view('hero_sections.create');
    }

    public function store(HeroSectionRequest $request)
    {
        $data = $request->validated();



   if($request->hasFile('image')){
    $aboutus = $request->file('image');
   $data['image']  =  $aboutusName = 'slider_'.time().'.'.$aboutus->getClientOriginalExtension();
    $aboutus->move(public_path('uploads/slider'), $aboutusName);

   }


        $data['is_active'] = $request->boolean('is_active');

        HeroSection::create($data);

        return redirect()->route('herosections.index')->with('success', 'Hero created.');
    }

    public function edit(HeroSection $herosection)
    {
        return view('hero_sections.edit', compact('herosection'));
    }

    public function update(HeroSectionRequest $request, HeroSection $herosection)
    {
        $data = $request->validated();


        if($request->hasFile('image')){
    $aboutus = $request->file('image');
   $data['image']  =  $aboutusName = 'slider_'.time().'.'.$aboutus->getClientOriginalExtension();
    $aboutus->move(public_path('uploads/slider'), $aboutusName);

   }


        $data['is_active'] = $request->boolean('is_active');

        $herosection->update($data);

        return redirect()->route('herosections.index')->with('success', 'Hero updated.');
    }

    public function destroy(HeroSection $herosection)
    {
        if ($herosection->image) {
            Storage::disk('public')->delete($herosection->image);
        }
        $herosection->delete();

        return redirect()->route('herosections.index')->with('success', 'Hero deleted.');
    }
}
