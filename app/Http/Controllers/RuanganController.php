<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRuanganRequest;
use App\Models\FormRuangan;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use App\Models\RuangLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    public function form()
    {
        $ruangs = RuangLab::all();
        $master = "peminjaman";
        return view('ruangan.form', compact('ruangs', 'master'));
    }

    public function store(FormRuanganRequest $request)
    {
        $minggu = $request->input('minggu');
        DB::transaction(function () use ($request, $minggu) {
            $peminjam = FormRuangan::create($request->validated());
            foreach ($minggu as $key => $value) {
                $ruangan = Ruangan::where('waktu', $peminjam->waktu)
                    ->where('hari', $peminjam->hari)
                    ->where('minggu', $value)->pluck('id')->first();

                PeminjamanRuangan::create([
                    'form_ruangan_id'   => $peminjam->id,
                    'ruangan_id'        => $ruangan,
                    'minggu'            => $value
                ]);
            }
        });
        return redirect()->route('ruangan.form')->with('msg', 'Pesan');
    }
}
