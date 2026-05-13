<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

/**
 * DashboardController: halaman utama dashboard admin.
 * Menampilkan ringkasan statistik penting untuk admin.
 */
class DashboardController extends Controller
{
    public function index()
    {
        // Statistik ringkasan pendaftaran
        $stats = [
            'total_pendaftar'  => Registration::count(),
            'pending'          => Registration::where('status', 'pending')->count(),
            'contacted'        => Registration::where('status', 'contacted')->count(),
            'trial'            => Registration::where('status', 'trial')->count(),
            'accepted'         => Registration::where('status', 'accepted')->count(),
        ];

        // 5 pendaftar terbaru
        $latestRegistrations = Registration::with('program')
            ->latestFirst()
            ->limit(5)
            ->get();

        $adminName = Auth::user()->name;

        return view('admin.dashboard.index', compact('stats', 'latestRegistrations', 'adminName'));
    }
}
