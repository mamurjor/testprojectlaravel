<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardControler extends Controller
{
    //
    public function dashboard(){
        return  view("admin.admin");
    }


     public function managerdashbaord(){
        return  view('admin.maangerdashboard');
    }

   public function agentdashbaord(){
        return  "this is agent";
    }

     public function memberdashbaord(){
        return  view('admin.memberdashboard');
    }

      public function userdashbaord(){
        return  "this is userdashbaord";
    }






}
