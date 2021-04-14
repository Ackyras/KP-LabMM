<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiPeminjamanRuanganMail;
use App\Models\FormRuangan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use App\Models\RuangLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PeminjamanRuanganController extends Controller
{
    public function index()
    {
        $kunci = null;
        $ruangans = FormRuangan::with('ruanglab')
            ->where('validasi', 1)
            ->orderBy('created_at')
            ->paginate(10);
        $id = $ruangans->pluck('id')->toArray();
        $peminjamans = PeminjamanRuangan::whereIn('form_ruangan_id', $id)->get();
        $ruanglab = RuangLab::all();
        return view('dashboard.peminjaman.ruangan.index', compact('ruangans', 'peminjamans', 'ruanglab', 'kunci'));
    }

    public function search(Request $request)
    {
        $input = '%' . $request->get('input') . '%';
        $ruangans = FormRuangan::with('ruanglab')
            ->where('nama_peminjam', 'like', $input)
            ->orWhere('afiliasi', 'like', $input)
            ->where('validasi', 1)
            ->orderBy('created_at')
            ->paginate(10);
        $id = $ruangans->pluck('id')->toArray();
        $peminjamans = PeminjamanRuangan::whereIn('form_ruangan_id', $id)->get();
        $ruanglab = RuangLab::all();
        $kunci = $request->get('input');
        return view('dashboard.peminjaman.ruangan.index', compact('ruangans', 'peminjamans', 'ruanglab', 'kunci'));
    }

    public function filter($slug)
    {
        $kunci = null;
        $ruang = RuangLab::where('slug', $slug)->first();
        $ruangans = FormRuangan::with('ruanglab')
            ->where('ruang_lab', $ruang->id)
            ->where('validasi', 1)
            ->orderBy('created_at')
            ->paginate(10);
        $id = $ruangans->pluck('id')->toArray();
        $peminjamans = PeminjamanRuangan::whereIn('form_ruangan_id', $id)->get();
        $ruanglab = RuangLab::all();
        return view('dashboard.peminjaman.ruangan.index', compact('ruangans', 'peminjamans', 'ruanglab', 'kunci'));
    }

    public function status(Request $request)
    {
        $id = $request->input('form_ruangan_id');
        switch ($request->input('action')) {
            case '0':
                FormRuangan::where('id', $id)->delete();
                break;
            case '1':
                $peminjam = FormRuangan::with('ruanglab')->where('id', $id)->first();
                $content = [
                    'nama'      => $peminjam->nama_peminjam,
                    'nim'       => $peminjam->nim,
                    'afiliasi'  => $peminjam->afiliasi,
                    'ruang'     => $peminjam->ruanglab->ruang,
                    'lokasi'    => $peminjam->ruanglab->lokasi,
                    'matkul'    => $peminjam->mata_kuliah,
                    'dosen'     => $peminjam->dosen,
                    'waktu'     => $peminjam->waktu,
                    'hari'      => $peminjam->hari,
                    'keterangan' => $peminjam->keterangan,
                    'pesan'     => $request->get('pesan'),
                    'validasi'  => 2
                ];
                FormRuangan::where('id', $id)->update(
                    [
                        'validasi'  => 2
                    ]
                );
                Mail::to($peminjam->email)->send(new VerifikasiPeminjamanRuanganMail($content));
                break;
            case '2':
                DB::transaction(function () use ($id, $request) {
                    $peminjamans = PeminjamanRuangan::with('formruangan')->where('form_ruangan_id', $id)->get();
                    foreach ($peminjamans as $peminjaman) {
                        Ruangan::where('ruang_lab', $peminjaman->formruangan->ruang_lab)
                            ->where('minggu', $peminjaman->minggu)
                            ->where('waktu', $peminjaman->formruangan->waktu)
                            ->where('hari', $peminjaman->formruangan->hari)
                            ->update(
                                [
                                    'status'        => 1,
                                    'updated_at'    => now()->toDateTimeString()
                                ]
                            );
                    }
                    FormRuangan::where('id', $id)->update(
                        [
                            'validasi'  => 0
                        ]
                    );
                    $peminjam = FormRuangan::with('ruanglab')->where('id', $id)->first();
                    $content = [
                        'nama'      => $peminjam->nama_peminjam,
                        'nim'       => $peminjam->nim,
                        'afiliasi'  => $peminjam->afiliasi,
                        'ruang'     => $peminjam->ruanglab->ruang,
                        'lokasi'    => $peminjam->ruanglab->lokasi,
                        'matkul'    => $peminjam->mata_kuliah,
                        'dosen'     => $peminjam->dosen,
                        'waktu'     => $peminjam->waktu,
                        'hari'      => $peminjam->hari,
                        'keterangan' => $peminjam->keterangan,
                        'pesan'     => $request->get('pesan'),
                        'validasi'  => 0
                    ];
                    Mail::to($peminjam->email)->send(new VerifikasiPeminjamanRuanganMail($content));
                });
                break;
        }

        return redirect()->route('peminjaman.ruangan')->with('status', 'Berhasil merubah status');
    }

    public function riwayat()
    {
        $kunci = null;
        $ruangans = FormRuangan::with('ruanglab')
            ->where('validasi', 0)
            ->orWhere('validasi', 2)
            ->orderByDesc('created_at')
            ->paginate(10);
        $id = $ruangans->pluck('id')->toArray();
        $peminjamans = PeminjamanRuangan::whereIn('form_ruangan_id', $id)->get();
        $ruanglab = RuangLab::all();
        return view('dashboard.peminjaman.ruangan.riwayat', compact('ruangans', 'peminjamans', 'ruanglab', 'kunci'));
    }

    public function searchriwayat(Request $request)
    {
        $input = '%' . $request->get('input') . '%';
        $ruangans = FormRuangan::with('ruanglab')
            ->where('nama_peminjam', 'like', $input)
            ->orWhere('afiliasi', 'like', $input)
            ->where('validasi', 0)
            ->orderByDesc('created_at')
            ->paginate(10);
        $id = $ruangans->pluck('id')->toArray();
        $peminjamans = PeminjamanRuangan::whereIn('form_ruangan_id', $id)->get();
        $ruanglab = RuangLab::all();
        $kunci = $request->get('input');
        return view('dashboard.peminjaman.ruangan.riwayat', compact('ruangans', 'peminjamans', 'ruanglab', 'kunci'));
    }

    public function riwayatfilter($slug)
    {
        $kunci = null;
        $ruang = RuangLab::where('slug', $slug)->first();
        $ruangans = FormRuangan::with('ruanglab')
            ->where('ruang_lab', $ruang->id)
            ->where('validasi', 0)
            ->orderByDesc('created_at')
            ->paginate(10);
        $id = $ruangans->pluck('id')->toArray();
        $peminjamans = PeminjamanRuangan::whereIn('form_ruangan_id', $id)->get();
        $ruanglab = RuangLab::all();
        return view('dashboard.peminjaman.ruangan.riwayat', compact('ruangans', 'peminjamans', 'ruanglab', 'kunci'));
    }
}
