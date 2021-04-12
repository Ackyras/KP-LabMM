<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Models\RuangLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RuanganController extends Controller
{
    public function index()
    {
        $ruanglabs = RuangLab::paginate(10);
        return view('dashboard.ruangan.index', compact('ruanglabs'));
    }

    public function create()
    {
        return view('dashboard.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'ruang'     => 'required',
                'lokasi'    => 'required',
                'status'    => 'required'
            ]
        );

        DB::transaction(function () use ($request) {
            $id = RuangLab::create(
                $request->all() +
                    [
                        'slug' => Str::slug($request->lokasi . ' ' . $request->ruang)
                    ]
            );
            $hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
            $waktu = ['07:00', '09:00', '13:00', '15:00'];
            for ($i = 1; $i < 17; $i++) {
                foreach ($hari as $key => $h) {
                    foreach ($waktu as $k => $w) {
                        Ruangan::create([
                            'ruang_lab' => $id->id,
                            'waktu'     => $w,
                            'hari'      => $h,
                            'minggu'    => $i
                        ]);
                    }
                }
            }
        });
        return redirect()->route('ruanglab.index')->with('status', 'Berhasil menambah ruangan');
    }

    public function edit($id)
    {
        $ruanglab = RuangLab::where('id', $id)->first();
        return view('dashboard.ruangan.edit', compact('ruanglab'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'ruang'     => 'required',
                'lokasi'    => 'required',
                'status'    => 'required'
            ]
        );

        RuangLab::where('id', $id)->update(
            [
                'ruang'     => $request->input('ruang'),
                'lokasi'    => $request->input('lokasi'),
                'status'    => $request->input('status'),
                'slug' => Str::slug($request->lokasi . ' ' . $request->ruang)
            ]
        );
        return redirect()->route('ruanglab.index')->with('status', 'Berhasil merubah ruangan');
    }

    public function destroy($id)
    {
        RuangLab::where('id', $id)->delete();
        return redirect()->route('ruanglab.index')->with('status', 'Berhasil menghapus ruangan');
    }
}
