<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect users to their correct role-based dashboard.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $role = Auth::user()->role;

        switch ($role) {
            case 'mahasiswa':
                return redirect()->route('dashboard.mahasiswa');
            case 'baak':
                return redirect()->route('dashboard.baak');
            case 'satpam':
                return redirect()->route('dashboard.satpam');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak valid.');
        }
    }

    /**
     * Mahasiswa Dashboard.
     */
    public function mahasiswa()
    {
        return redirect()->route('mahasiswa.pengajuan');
    }

    /**
     * BAAK Dashboard.
     */
    public function baak()
    {
        return view('baak.dashboard');
    }

    /**
     * Satpam Dashboard.
     */
    public function satpam()
    {
        return view('satpam.dashboard');
    }
}
