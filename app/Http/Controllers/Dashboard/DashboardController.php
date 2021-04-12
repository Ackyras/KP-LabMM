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
        $formbarangs = FormBarang::where('created_at', '>=', Carbon::today()->format('Y-m-d H:i:s'))
            ->orderBy('created_at')
            ->take(5)
            ->get();
        $formruangans = FormRuangan::with('ruanglab')
            ->where('validasi', 1)
            ->where('created_at', '>=', Carbon::today()->subDays(5)->format('Y-m-d H:i:s'))
            ->orderBy('created_at')
            ->take(5)
            ->get();
        $barangs = PeminjamanBarang::with('inventaris')->get();
        $ruangans = PeminjamanRuangan::all();
        $banyakformbarang = FormBarang::where('created_at', '>=', Carbon::today()->format('Y-m-d H:i:s'))->count();
        $banyakformruangan = FormRuangan::where('created_at', '>=', Carbon::today()->format('Y-m-d H:i:s'))->count();
        $barangbelumkembali = FormBarang::where('validasi', 2)
            ->where('tanggal_pengembalian', '<', Carbon::today()->format('Y-m-d'))
            ->get()
            ->pluck('id')
            ->toArray();
        $barangbelumkembali = PeminjamanBarang::whereIn('form_barang_id', $barangbelumkembali)->count();
        $barangdipinjam = FormBarang::where('validasi', 2)
            ->get()
            ->pluck('id')
            ->toArray();
        $barangdipinjam = PeminjamanBarang::whereIn('form_barang_id', $barangdipinjam)->count();
        $barangpinjamans = FormBarang::where('validasi', 2)
            ->get()
            ->pluck('id')
            ->toArray();
        $barangpinjamans = PeminjamanBarang::with(['inventaris', 'formbarang'])
            ->whereIn('form_barang_id', $barangpinjamans)
            ->paginate(3);
        $peminjamtelats = FormBarang::where('validasi', 2)
            ->where('tanggal_pengembalian', '<', Carbon::today()->format('Y-m-d'))
            ->paginate(5);
        return view('dashboard.index', compact('formbarangs', 'formruangans', 'barangs', 'ruangans', 'banyakformbarang', 'banyakformruangan', 'barangbelumkembali', 'barangdipinjam', 'barangpinjamans', 'peminjamtelats'));
    }
}
