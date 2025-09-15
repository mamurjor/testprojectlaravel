<?php

namespace App\Http\Controllers;

use App\Models\FeatureCard;
use App\Http\Requests\FeatureCardRequest;

class FeatureCardController extends Controller
{
    // Admin: list
    public function index()
    {
        $items = FeatureCard::ordered()->latest('id')->paginate(20);
        return view('featurecards.index', compact('items'));
    }

    public function create()
    {
        return view('featurecards.create');
    }

    public function store(FeatureCardRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        FeatureCard::create($data);
        return redirect()->route('featurecards.index')->with('success', 'Feature created.');
    }

    public function edit(FeatureCard $featurecard)
    {
        return view('featurecards.edit', compact('featurecard'));
    }

    public function update(FeatureCardRequest $request, FeatureCard $featurecard)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $featurecard->update($data);
        return redirect()->route('featurecards.index')->with('success', 'Feature updated.');
    }

    public function destroy(FeatureCard $featurecard)
    {
        $featurecard->delete();
        return redirect()->route('featurecards.index')->with('success', 'Feature deleted.');
    }
}
