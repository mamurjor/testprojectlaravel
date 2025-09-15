<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;


class PostAdminController extends Controller
{
public function __construct() { $this->middleware(['auth']); }


public function index()
{


$posts = Post::latest()->paginate(20);

return view('admin.posts.index', compact('posts'));
}


public function create()
{

return view('admin.posts.create', ['categories'=>Category::orderBy('name')->get()]);

}


public function store(Request $request)
{
$data = $request->validate([
'title' => 'required|string|max:255',
'slug' => 'nullable|string|max:255|unique:posts,slug',
'excerpt' => 'nullable|string|max:500',
'content' => 'required|string',
'status' => 'required|in:draft,published,scheduled',
'published_at' => 'nullable|date',
'categories' => 'array',
'categories.*' => 'exists:categories,id',
]);

        if ($request->hasFile('featured_image')) {
            $aboutus = $request->file('featured_image');
        $data['featured_image']=  $aboutusName = 'featured_image_'.time().'.'.$aboutus->getClientOriginalExtension();
            $aboutus->move(public_path('uploads/post_featured_image'), $aboutusName);
            }

$post = Post::create(array_merge($data, ['user_id' => $request->user()->id]));
$post->categories()->sync($request->input('categories', []));
return redirect()->route('posts.index', $post)->with('success','Post created');
}


public function edit(Post $post)
{
return view('admin.posts.edit', [
'post'=>$post->load('categories'),
'categories'=>Category::orderBy('name')->get()
]);
}


public function update(Request $request, Post $post)
{
$data = $request->validate([
'title' => 'required|string|max:255',
'slug' => 'nullable|string|max:255|unique:posts,slug,'.$post->id,
'excerpt' => 'nullable|string|max:500',
'content' => 'required|string',
'status' => 'required|in:draft,published,scheduled',
'published_at' => 'nullable|date',
'categories' => 'array',
'categories.*' => 'exists:categories,id',
]);
$post->update($data);
$post->categories()->sync($request->input('categories', []));
return redirect()->route('posts.index', $post)->with('success','Post updated');
}


public function destroy(Post $post)
{
$post->delete();
return back()->with('success','Post moved to trash');
}
}
