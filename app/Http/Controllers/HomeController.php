<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\SuratKontrak;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pengajuan = Pengajuan::all();
        $surat = SuratKontrak::all();
        return view('home', compact('pengajuan', 'surat'));
    }
}
