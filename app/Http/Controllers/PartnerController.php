<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Http\Requests\PartnerRequest;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $items = Partner::ordered()->latest('id')->paginate(30);
        return view('partners.index', compact('items'));
    }

    public function create() { return view('partners.create'); }

    public function store(PartnerRequest $request)
    {
        $data = [
            'name'        => $request->name,
            'website_url' => $request->website_url,
            'sort_order'  => $request->input('sort_order', 0),
            'is_active'   => $request->boolean('is_active'),
        ];



           if($request->hasFile('logo')){
        $aboutus = $request->file('logo');
    $data['logo']  =  $aboutusName = 'logo_'.time().'.'.$aboutus->getClientOriginalExtension();
        $aboutus->move(public_path('uploads/partner'), $aboutusName);
           }

        Partner::create($data);
        return redirect()->route('partners.index')->with('success','Partner created.');
    }

    public function edit(Partner $partner) { return view('partners.edit', compact('partner')); }

    public function update(PartnerRequest $request, Partner $partner)
    {
        $partner->name        = $request->name;
        $partner->website_url = $request->website_url;
        $partner->sort_order  = $request->input('sort_order', 0);
        $partner->is_active   = $request->boolean('is_active');

         if($request->hasFile('logo')){
        $aboutus = $request->file('logo');
    $data['logo']  =  $aboutusName = 'logo_'.time().'.'.$aboutus->getClientOriginalExtension();
        $aboutus->move(public_path('uploads/partner'), $aboutusName);
           }

        $partner->save();

        return redirect()->route('partners.index')->with('success','Partner updated.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo && !str_starts_with($partner->logo,'http')) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();
        return redirect()->route('partners.index')->with('success','Partner deleted.');
    }
}
