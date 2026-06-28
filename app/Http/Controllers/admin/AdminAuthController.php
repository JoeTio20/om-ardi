<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Session::get('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah email ada di database
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withInput()->with('error_type', 'email');
        }

        // Cek password
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withInput()->with('error_type', 'password');
        }

        // Login berhasil
        Session::put('admin_logged_in', true);
        Session::put('admin_name', $admin->name);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Session::forget(['admin_logged_in', 'admin_name']);
        return redirect()->route('admin.login');
    }
}
