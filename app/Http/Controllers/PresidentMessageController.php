<?php

namespace App\Http\Controllers;

use App\Models\PresidentMessage;
use Illuminate\Http\Request;
class PresidentMessageController extends Controller
{
    public function index(){
        $items = PresidentMessage::latest()->paginate(10);

        return view('president.index', compact('items'));
    }
    public function create(){ return view('president.create'); }

    public function store(Request $r){
        $data = $r->validate([
            'heading'      => 'nullable|string',
            'person_name'  => 'required|string',
            'person_title' => 'nullable|string',
            'avatar'       => 'nullable|image',
            'quote'        => 'required|string',
            'badge_text'   => 'nullable|string',
            'read_more_url'=> 'nullable|url',
            'is_active'    => 'sometimes|boolean',
        ]);




            if($r->hasFile('avatar')){
                $aboutus = $r->file('avatar');
                $data['avatar']  =  $aboutusName = 'avatar_'.time().'.'.$aboutus->getClientOriginalExtension();
                $aboutus->move(public_path('uploads/president/'), $aboutusName);
            }



        $data['is_active'] = $r->boolean('is_active');
       $test = PresidentMessage::create($data);

        return redirect()->route('president.index')->with('success','Saved.');
    }

    public function edit(PresidentMessage $president){
        return view('president.edit', compact('president'));
    }

    public function update(Request $r, PresidentMessage $president){
        $data = $r->validate([
            'heading'      => 'nullable|string|max:120',
            'person_name'  => 'required|string|max:120',
            'person_title' => 'nullable|string|max:160',
            'avatar'       => 'nullable|image',
            'quote'        => 'required|string',
            'badge_text'   => 'nullable|string|max:20',
            'read_more_url'=> 'nullable|url|max:255',
            'is_active'    => 'sometimes|boolean',
        ]);



            if($request->hasFile('avatar')){
                $aboutus = $request->file('avatar');
                $data['avatar']  =  $aboutusName = 'avatar_'.time().'.'.$aboutus->getClientOriginalExtension();
                $aboutus->move(public_path('uploads/president/'), $aboutusName);
            }



        $data['is_active'] = $r->boolean('is_active');
        $president->update($data);
        return redirect()->route('president.index')->with('success','Updated.');
    }

    public function destroy(PresidentMessage $president){

        $president->delete();
        return back()->with('success','Deleted.');
    }
}
