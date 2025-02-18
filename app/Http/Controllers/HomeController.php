<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda (landing page).
     */
    public function index()
    {
        // Ambil daftar studio untuk ditampilkan di beranda
        $studios = Studio::latest()->take(3)->get(); // Hanya menampilkan 3 studio terbaru

        return view('home', compact('studios'));
    }
}
