<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryAdminController extends Controller
{
public function __construct() { $this->middleware(['auth']); }


public function index() {
//$categories = Category::orderBy('name')->paginate(30);
 $categories = Category::with('parent')->orderBy('name')->paginate(15);
return view('admin.categories.index', compact('categories'));
}


public function create() {
return view('admin.categories.create', ['parents'=>Category::orderBy('name')->get()]);
}


public function store(Request $request) {
$data = $request->validate([
'name' => 'required|max:255',
'slug' => 'nullable|max:255|unique:categories,slug',
'description' => 'nullable',
'parent_id' => 'nullable|exists:categories,id',
]);
$category = Category::create($data);
return redirect()->route('categories.index', $category)->with('success','Category created');
}


public function edit(Category $category) {


return view('admin.categories.edit', [
'category'=>$category,
'parents'=>Category::whereKeyNot($category->id)->orderBy('name')->get()
]);
}


public function update(Request $request, Category $category) {
$data = $request->validate([
'name' => 'required|max:255',
'slug' => 'nullable|max:255|unique:categories,slug,'.$category->id,
'description' => 'nullable',
'parent_id' => 'nullable|exists:categories,id',
]);
 $category->update($data);
return redirect()->route('categories.index')->with('success','Category Updated');
}


public function destroy(Category $category) {
$category->delete();
return back()->with('success','Category moved to trash');
}
}
