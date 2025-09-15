<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;


use App\Http\Requests\FaqRequest;

class FaqController extends Controller
{
    public function index()
    {

        $faqs = Faq::ordered()->latest('id')->paginate(20);
        return view('faqs.index', compact('faqs'));
    }

    public function create(){ return view('faqs.create'); }

    public function store(FaqRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        Faq::create($data);
        return redirect()->route('faqs.index')->with('success','FAQ created.');
    }

    public function edit(Faq $faq)
    {
        return view('faqs.edit', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $faq->update($data);
        return redirect()->route('faqs.index')->with('success','FAQ updated.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success','FAQ deleted.');
    }
}

