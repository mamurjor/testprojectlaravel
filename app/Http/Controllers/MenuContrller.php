<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
class MenuContrller extends Controller
{
    //

    public function addform(){
        $menus = Menu::whereNull('parent_id')
             ->when(isset($menu), fn($q) => $q->where('id', '!=', $menu->id))
             ->get();
        return view('admin.menu.addform',compact('menus'));
    }
}
