<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // แสดงหน้า Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // ประมวลผลเข้าสู่ระบบจากฐานข้อมูลจริง
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // แยกหน้าตามสิทธิ์ (Admin ไปหน้าช่าง / User ไปหน้าแจ้งซ่อม)
            if ($user->role === 'admin') {
                return redirect()->route('technician.dashboard');
            }
            return redirect()->route('repairs.create');
        }

        return back()->withErrors([
            'email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
        ])->onlyInput('email');
    }

    // แสดงหน้าสมัครสมาชิก
    public function showRegister()
    {
        return view('auth.register');
    }

    // บันทึกข้อมูลสมัครสมาชิกเข้าฐานข้อมูลจริง
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,admin'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('technician.dashboard');
        }
        return redirect()->route('repairs.create');
    }

    // ออกจากระบบ
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}