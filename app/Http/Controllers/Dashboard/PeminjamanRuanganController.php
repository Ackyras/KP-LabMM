<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamanRuanganController extends Controller
{
    public function index() {
        return view(
            'dashboard.peminjaman.ruangan.index',
            [
                'data' => DB::table('form_ruangan')
                    ->where('validasi', '1')
                    ->orWhere('validasi', '2')
                    ->orderBy('created_at', 'desc')
                    ->paginate(20)
            ]
        )
    }
}
