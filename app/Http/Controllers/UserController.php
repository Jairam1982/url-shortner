<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function loginForm() {
        return view("user.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            $redirect = ''; 
            if($user->role == User::ROLE_SUPERADMIN) {
                $redirect = route('super-admin-dashboard');
            } else if($user->role == User::ROLE_ADMIN) {
                $redirect = route('admin-dashboard');
            } else {
                $redirect = route('member-dashboard');
            }
            return redirect($redirect);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}