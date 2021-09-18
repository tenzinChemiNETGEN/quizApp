<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @return Dashboard
     */
   

    public function index(){
        return view('dashboard');
    }

    

}
