<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News; // Pastikan model News diimport

class UserDashboardController extends Controller
{
    /**
     * Display the user's specific dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login (opsional, jika ingin menampilkan nama user)

        // Mengambil 6 berita terbaru. Anda bisa menyesuaikan jumlahnya.
        // Jika Anda memiliki kolom 'status' di tabel berita untuk menandai 'published',
        // Anda bisa menambahkan ->where('status', 'published') setelah News::
        $newsItems = News::latest()->limit(6)->get();

        // Mengirimkan data user dan newsItems ke view
        return view('user.dashboard', compact('user', 'newsItems'));
    }
}