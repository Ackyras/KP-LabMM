<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Models\RuangLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    public function index()
    {
        $ruanglabs = RuangLab::simplePaginate(10);
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
            $id = RuangLab::create($request->all());
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
        return redirect()->route('ruanglab.index');
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
                'status'    => $request->input('status')
            ]
        );
        return redirect()->route('ruanglab.index');
    }

    public function destroy($id)
    {
        RuangLab::where('id', $id)->delete();
        return redirect()->route('ruanglab.index');
    }
}
