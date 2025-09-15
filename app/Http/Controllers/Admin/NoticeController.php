<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNoticeEmailJob;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {

        $notices = Notice::orderByDesc('id')->paginate(15);
        return view('admin.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'body'  => ['required','string'],
            'send_now' => ['nullable','boolean'], // checkbox
        ]);

        $notice = Notice::create([
            'title' => $data['title'],
            'body'  => $data['body'],
        ]);

        // যদি send_now টিক দেওয়া থাকে—Queue এ ইমেইল জব
        if ($request->boolean('send_now')) {
            dispatch(new SendNoticeEmailJob($notice));
        }

        return redirect()->route('notices.index')->with('ok','Notice created'.($request->boolean('send_now')?' & emails queued!':''));
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();
        return back()->with('ok','Notice deleted');
    }
}
