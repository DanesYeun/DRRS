<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

     
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {

            $user = Auth::user();

            // Store user data in session
            session(['user_data' => $user]);

            // Redirect based on the user's role
            switch ($user->role) {
                case 1:
                    return redirect()->intended('dashboard1');
                case 2:
                    return redirect()->intended('dashboard2');
                case 3:
                    return redirect()->intended('dashboard3');
                default:
                    return redirect()->back()->with('error', 'Role doesn\'t exist');
            }
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }


}

