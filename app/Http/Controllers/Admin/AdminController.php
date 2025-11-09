<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
     public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function dashboard()
    {
        // dd("Dfdf");
        return view('dashboard'); // make sure dashboard.blade.php exists
    }
    public function login()
    {
          if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('login');

    }
    public function register()
    {
        return view('register');
    }
    public function logout(Request $request)
    {
        
          Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
           
    }
}
