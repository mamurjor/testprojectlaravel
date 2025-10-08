<?php
// app/Http/Controllers/Admin/PageController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PageController extends Controller
{
     public function index(Request $request)
    {
        $q      = $request->get('q');
        $status = $request->get('status', 'all');     // all|draft|published
        $sort   = $request->get('sort', 'newest');    // newest|oldest|title_asc|title_desc

        $pages = Page::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function($qq) use ($q) {
                    $qq->where('title', 'like', "%$q%")
                       ->orWhere('slug', 'like', "%$q%");
                });
            })
            ->when(in_array($status, ['draft','published']), fn($query) => $query->where('status', $status))
            ->when($sort, function ($query) use ($sort) {
                return match ($sort) {
                    'oldest'     => $query->orderBy('updated_at', 'asc'),
                    'title_asc'  => $query->orderBy('title', 'asc'),
                    'title_desc' => $query->orderBy('title', 'desc'),
                    default      => $query->orderBy('updated_at', 'desc'), // newest
                };
            })
            ->paginate(12)
            ->withQueryString();

        return view('admin.pages.index', compact('pages','q','status','sort'));
    }

    public function bulk(Request $request)
    {
        $data = $request->validate([
            'action' => 'required|in:publish,draft,delete',
            'ids'    => 'required|array',
            'ids.*'  => 'integer|exists:pages,id',
        ],[
            'ids.required' => 'Please select at least one page.'
        ]);

        $ids    = $data['ids'];
        $action = $data['action'];
        $count  = 0;

        if ($action === 'delete') {
            // optional: featured_image ফাইল মুছুন
            $toDelete = Page::whereIn('id', $ids)->get();
            foreach ($toDelete as $p) {
                if ($p->featured_image && file_exists(public_path($p->featured_image))) {
                    @unlink(public_path($p->featured_image));
                }
            }
            $count = Page::whereIn('id', $ids)->delete();
        } elseif ($action === 'publish') {
            $count = Page::whereIn('id', $ids)->update(['status' => 'published', 'published_at' => now()]);
        } else { // draft
            $count = Page::whereIn('id', $ids)->update(['status' => 'draft']);
        }

        return back()->with('success', "Bulk action '{$action}' applied on {$count} page(s).");
    }

    public function create()
    {
        $page = new Page();
        return view('admin.pages.form', compact('page'));
    }

    public function image(Request $request)
    {
        $request->validate([
            'file' => ['required','image','mimes:jpeg,png,webp'], // 2MB
        ]);

        // ফোল্ডার গঠন: public/uploads/YYYY/MM
        $path = $request->file('file')->store(
            'uploads/'.now()->format('Y/m'), 'public'
        );

        // public disk -> /storage symlink দরকার
        return response()->json([
            'url' => asset('storage/'.$path),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:200',
            'slug'    => 'nullable|string|max:220|unique:pages,slug',
            'content' => 'nullable|string',
            'status'  => 'required|string|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string|max:255',
            'published_at'     => 'nullable|date',
        ]);

        // Image upload
        if ($request->hasFile('featured_image')) {
            $file   = $request->file('featured_image');
            $name   = 'page_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $name);
            $data['featured_image'] = 'uploads/pages/'.$name;
        }

        Page::create($data);

        return redirect()->route('pages.index')->with('success','Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:200',
            'slug'    => 'nullable|string|max:220|unique:pages,slug,'.$page->id,
            'content' => 'nullable|string',
            'status'  => 'required|string|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string|max:255',
            'published_at'     => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            // পুরনো ফাইল ডিলিট (optional)
            if ($page->featured_image && file_exists(public_path($page->featured_image))) {
                @unlink(public_path($page->featured_image));
            }
            $file   = $request->file('featured_image');
            $name   = 'page_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $name);
            $data['featured_image'] = 'uploads/pages/'.$name;
        }

        $page->update($data);

        return redirect()->route('pages.index')->with('success','Page updated successfully.');
    }

    public function destroy(Page $page)
    {


        if ($page->featured_image && file_exists(public_path($page->featured_image))) {
            @unlink(public_path($page->featured_image));
        }
        $page->delete();
        return back()->with('success','Page deleted.');
    }
}
