<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
public function index()
{
$posts = Post::published()->latest('published_at')->with('author','categories')->paginate(10);
$categories = Category::orderBy('name')->get();
return view('admin.posts.blog', compact('posts','categories'));
}


public function show(Post $post)
{

    // Main post with author & categories
    // $post->load(['author:id,name', 'categories:id,name,slug']);

    // Related (share at least one category)
    $related = Post::published()
        ->take(3)
        ->get();

    // Recent for sidebar
    $recent =Post::published()
        ->latest()
        ->take(3)
        ->get();

    // Prev/Next by published_at
    $prev = Post::published()
        ->where('published_at', '<', $post->published_at)
        ->latest()
        ->first();

    $next = Post::published()
        ->where('published_at', '>', $post->published_at)
        ->oldest('published_at')
        ->first(['id','title','slug','published_at']);

    return view('blog.show', compact('post','related','recent','prev','next'));

}


public function category(Category $category)
{
$posts = $category->posts()->published()->latest('published_at')->paginate(10);
return view('blog.category', compact('category','posts'));
}
}
