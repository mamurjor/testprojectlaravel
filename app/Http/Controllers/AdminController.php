<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Auth middleware, যাতে লগ ইন করতে হয়
    }

    // ইভেন্ট লিস্ট দেখানো (Admin Panel)
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    // নতুন ইভেন্ট তৈরি ফর্ম
    public function create()
    {
        return view('admin.event.create');
    }

    // নতুন ইভেন্ট সেভ করা
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'end_date' => 'required|date',
            'max_registrations' => 'nullable|integer',
            'is_free' => 'required|boolean',
        ]);

        Event::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Event created successfully!');
    }

    // ইভেন্ট আপডেট ফর্ম
    public function edit(Event $event)
    {

        return view('admin.event.edit', compact('event'));
    }

    // ইভেন্ট আপডেট করা
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'end_date' => 'required|date',
            'max_registrations' => 'nullable|integer',
            'is_free' => 'required|boolean',
        ]);

        $event->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Event updated successfully!');
    }

    // ইভেন্ট ডিলিট করা
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.index')->with('success', 'Event deleted successfully!');
    }
}

