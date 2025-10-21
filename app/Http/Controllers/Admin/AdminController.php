<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');

    }
    public function register()
    {
        return view('register');
    }
    public function logout(Request $request)
    {
        dd($request->all());
          return redirect()->back()->withErrors($validator)->withInput();
           
    }
}
