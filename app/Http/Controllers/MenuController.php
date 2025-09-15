<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(Request $request)
    {
          $query = Menu::with('children', 'parent'); // children & parent লোড করা

    if ($request->has('search')) {
        $search = $request->search;
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('slug', 'like', "%{$search}%");
    }

    $menus = $query->whereNull('parent_id')->orderBy('order')->paginate(10);

    return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {


        $menus = Menu::whereNull('parent_id')
             ->when(isset($menu), fn($q) => $q->where('id', '!=', $menu->id))
             ->get();

        return view('admin.menus.create',compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'icon' => 'nullable|string',
            'class' => 'nullable|string',
            'slug' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
        ]);

        Menu::create($request->all());
        return redirect()->route('menus.index')->with('success', 'Menu created successfully');
    }

    public function edit(Menu $menu)
    {
        $menus = Menu::whereNull('parent_id')->where('id','!=',$menu->id)->get();
        return view('admin.menus.edit', compact('menu','menus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required',
            'icon' => 'nullable|string',
            'class' => 'nullable|string',
            'slug' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
        ]);

        $menu->update($request->all());
        return redirect()->route('menus.index')->with('success','Menu updated successfully');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success','Menu deleted successfully');
    }

    // ফ্রন্টএন্ডে মেনু দেখানোর জন্য
    public function frontendMenu()
    {
        $menus = Menu::whereNull('parent_id')->orderBy('order')->with('children')->get();
        return view('menus.frontend', compact('menus'));
    }
}
