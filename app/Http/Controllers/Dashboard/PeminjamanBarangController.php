<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FormBarang;
use App\Models\Inventaris;
use App\Models\PeminjamanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanBarangController extends Controller
{
    public function index()
    {
        $kunci = null;
        $forms = FormBarang::where('validasi', '1')
            ->orWhere('validasi', '2')
            ->orderByDesc('updated_at')
            ->paginate(10);
        $barangs = PeminjamanBarang::with('inventaris')->get();
        return view('dashboard.peminjaman.barang.index', compact('forms', 'barangs', 'kunci'));
    }

    public function filter($status)
    {
        $kunci = null;
        $forms = FormBarang::where('validasi', $status)
            ->orderByDesc('updated_at')
            ->paginate(10);
        $barangs = PeminjamanBarang::with('inventaris')->get();
        return view('dashboard.peminjaman.barang.index', compact('forms', 'barangs', 'kunci'));
    }

    public function search(Request $request)
    {
        $input = '%' . $request->get('input') . '%';
        $forms = FormBarang::where('nama_peminjam', 'like', $input)
            ->orWhere('afiliasi', 'like', $input)
            ->paginate(10);
        $barangs = PeminjamanBarang::with('inventaris')->get();
        $kunci = $request->get('input');
        return view('dashboard.peminjaman.barang.index', compact('forms', 'barangs', 'kunci'));
    }

    public function status(Request $request)
    {
        $form_barang_id = $request->input('form_barang_id');
        switch ($request->input('action')) {
            case '2':
                DB::transaction(function () use ($form_barang_id) {
                    FormBarang::where('id', $form_barang_id)->update([
                        'validasi'              => '2',
                        'updated_at'            => now()->toDateTimeString()
                    ]);
                    $peminjaman = PeminjamanBarang::where('form_barang_id', $form_barang_id)->get();
                    foreach ($peminjaman as $pem) {
                        $inven = Inventaris::where('id', $pem->barang_id)->first();
                        $inven->update([
                            'peminjaman' => $inven->peminjaman - $pem->jumlah
                        ]);
                    }
                }, 5);
                break;
            case '0':
                DB::transaction(function () use ($form_barang_id) {
                    FormBarang::where('id', $form_barang_id)->update([
                        'validasi'              => '0',
                        'updated_at'            => now()->toDateTimeString()
                    ]);
                    $peminjaman = PeminjamanBarang::where('form_barang_id', $form_barang_id)->get();
                    foreach ($peminjaman as $pem) {
                        $inven = Inventaris::where('id', $pem->barang_id)->first();
                        $inven->update([
                            'peminjaman' => $inven->peminjaman + $pem->jumlah
                        ]);
                    }
                }, 5);
                break;
            case '3':
                FormBarang::where('id', $form_barang_id)->delete();
                break;
        }

        return redirect()->route('peminjaman.barang')->with('status', 'Berhasil merubah status');
    }

    public function telat()
    {
        $kunci = null;
        $forms = FormBarang::where('validasi', 2)
            ->where('tanggal_pengembalian', '<', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))
            ->orderByDesc('updated_at')
            ->paginate(10);
        $barangs = PeminjamanBarang::with('inventaris')->get();
        return view('dashboard.peminjaman.barang.index', compact('forms', 'barangs', 'kunci'));
    }

    public function riwayat()
    {
        $kunci = null;
        $forms = FormBarang::where('validasi', 0)
            ->orderByDesc('updated_at')
            ->paginate(10);
        $id = $forms->pluck('id')->toArray();
        $barangs = PeminjamanBarang::with('inventaris')
            ->whereIn('form_barang_id', $id)
            ->get();

        return view('dashboard.peminjaman.barang.riwayat', compact('forms', 'barangs', 'kunci'));
    }

    public function searchriwayat(Request $request)
    {
        $input = '%' . $request->get('input') . '%';
        $forms = FormBarang::where('validasi', 0)
            ->where('nama_peminjam', 'like', $input)
            ->orWhere('afiliasi', 'like', $input)
            ->orderByDesc('updated_at')
            ->paginate(10);
        $id = $forms->pluck('id')->toArray();
        $barangs = PeminjamanBarang::with('inventaris')
            ->whereIn('form_barang_id', $id)
            ->get();
        $kunci = $request->get('input');
        return view('dashboard.peminjaman.barang.riwayat', compact('forms', 'barangs', 'kunci'));
    }
}
