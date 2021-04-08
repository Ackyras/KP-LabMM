<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FormBarang;
use App\Models\FormRuangan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $formbarangs = FormBarang::where('created_at', '>=', Carbon::today())->take(5)->orderBy('created_at')->get();
        $formruangans = FormRuangan::has('ruanglab')->where('created_at', '>=', Carbon::today())->take(5)->orderBy('created_at')->get();
        $barangs = PeminjamanBarang::with('inventaris')->get();
        $ruangans = PeminjamanRuangan::all();
        $banyakform = FormBarang::where('created_at', '>=', Carbon::today())->count();
        $barangdipinjam = FormBarang::where('validasi', 2)->get()->pluck('id')->toArray();
        $barangdipinjam = PeminjamanBarang::where();
        dd($barangdipinjam);
        return view('dashboard.index', compact('formbarangs', 'formruangans', 'barangs', 'ruangans', 'banyakform'));
    }
}
