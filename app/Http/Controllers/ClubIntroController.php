<?php

namespace App\Http\Controllers;

use App\Models\ClubIntro;
use Illuminate\Http\Request;
class ClubIntroController extends Controller
{
    public function index() {
        $items = ClubIntro::latest()->paginate(10);
        return view('clubintro.index', compact('items'));
    }

    public function create() { return view('clubintro.create'); }

    public function store(Request $r) {
        $data = $r->validate([
            'title' => 'required|string|max:255',
            'body'  => 'nullable|string',
            'bullet_points_raw' => 'nullable|string', // textarea থেকে লাইন ব্রেক
            'btn1_text' => 'nullable|string|max:80',
            'btn1_url'  => 'nullable|url|max:255',
            'btn2_text' => 'nullable|string|max:80',
            'btn2_url'  => 'nullable|url|max:255',
            'is_active' => 'sometimes|boolean',
        ]);
        $bp = collect(preg_split("/\r\n|\n|\r/", $r->bullet_points_raw ?? ''))
                ->filter(fn($v)=>trim($v) !== '')->values()->all();

        ClubIntro::create([
            'title' => $data['title'],
            'body'  => $data['body'] ?? null,
            'bullet_points' => $bp ?: null,
            'btn1_text' => $data['btn1_text'] ?? null,
            'btn1_url'  => $data['btn1_url'] ?? null,
            'btn2_text' => $data['btn2_text'] ?? null,
            'btn2_url'  => $data['btn2_url'] ?? null,
            'is_active' => $r->boolean('is_active'),
        ]);
        return redirect()->route('clubintro.index')->with('success','Saved.');
    }

    public function edit(ClubIntro $clubintro) {
        return view('clubintro.edit', compact('clubintro'));
    }

    public function update(Request $r, ClubIntro $clubintro) {
        $data = $r->validate([
            'title' => 'required|string|max:255',
            'body'  => 'nullable|string',
            'bullet_points_raw' => 'nullable|string',
            'btn1_text' => 'nullable|string|max:80',
            'btn1_url'  => 'nullable|url|max:255',
            'btn2_text' => 'nullable|string|max:80',
            'btn2_url'  => 'nullable|url|max:255',
            'is_active' => 'sometimes|boolean',
        ]);
        $bp = collect(preg_split("/\r\n|\n|\r/", $r->bullet_points_raw ?? ''))
                ->filter(fn($v)=>trim($v) !== '')->values()->all();

        $clubintro->update([
            'title' => $data['title'],
            'body'  => $data['body'] ?? null,
            'bullet_points' => $bp ?: null,
            'btn1_text' => $data['btn1_text'] ?? null,
            'btn1_url'  => $data['btn1_url'] ?? null,
            'btn2_text' => $data['btn2_text'] ?? null,
            'btn2_url'  => $data['btn2_url'] ?? null,
            'is_active' => $r->boolean('is_active'),
        ]);
        return redirect()->route('clubintro.index')->with('success','Updated.');
    }

    public function destroy(ClubIntro $clubintro) {
        $clubintro->delete();
        return back()->with('success','Deleted.');
    }
}

