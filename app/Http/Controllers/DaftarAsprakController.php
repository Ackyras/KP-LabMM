<?php

namespace App\Http\Controllers;

use App\Models\CalonAsprak;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use App\Models\PenilaianAsprak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DaftarAsprakController extends Controller
{
    public function index()
    {
        $pembukaan = PembukaanAsprak::latest()->first();
        $matakuliahs = MataKuliah::with('daftarmatakuliah')->where('pembukaan_asprak_id', $pembukaan->id)->get();
        return view('asprak.index', compact('matakuliahs'));
    }

    public function form()
    {
        $pembukaan = PembukaanAsprak::latest()->pluck('id')->first();
        $matakuliahs = MataKuliah::with('daftarmatakuliah')
            ->where('pembukaan_asprak_id', $pembukaan)
            ->get();
        return view('asprak.form', compact('matakuliahs'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'nama'          => ['required'],
                'nim'           => ['required', 'regex:/[0-9]+/', 'min:8', 'max:9'],
                'email'         => ['required', 'email'],
                'tanggal_lahir' => ['required', 'date'],
                'prodi'         => ['required'],
                'angkatan'      => ['required', 'regex:/[0-9]+/'],
                'cv'            => ['mimes:pdf,jpeg,png,jpg', 'max:512', 'required'],
                'khs'           => ['mimes:pdf,jpeg,png,jpg', 'max:512', 'required'],
                'ktm'           => ['mimes:pdf,jpeg,png,jpg', 'max:512', 'required']
            ]
        );

        if ($request->hasFile('cv') and $request->hasFile('khs') and $request->hasFile('ktm')) {
            $cv = $request->file('cv');
            $khs = $request->file('khs');
            $ktm = $request->file('ktm');
            $path = 'public/calon/' . $request->input('nim');

            $storecv = $cv->storeAs($path, $cv->getClientOriginalName());
            $storekhs = $khs->storeAs($path, $khs->getClientOriginalName());
            $storektm = $ktm->storeAs($path, $ktm->getClientOriginalName());

            $link_cv = $request->root() . '/storage/calon/' . $request->input('nim') . '/' . $cv->getClientOriginalName();
            $link_khs = $request->root() . '/storage/calon/' . $request->input('nim') . '/' . $khs->getClientOriginalName();
            $link_ktm = $request->root() . '/storage/calon/' . $request->input('nim') . '/' . $ktm->getClientOriginalName();

            $cv = Storage::url($storecv);
            $khs = Storage::url($storekhs);
            $ktm = Storage::url($storektm);
        }
        DB::transaction(function () use ($request, $link_cv, $link_khs, $link_ktm) {
            $id = CalonAsprak::create(
                [
                    'nama'              => $request->input('nama'),
                    'nim'               => $request->input('nim'),
                    'email'             => $request->input('email'),
                    'tanggal_lahir'     => $request->input('tanggal_lahir'),
                    'program_studi'     => $request->input('prodi'),
                    'angkatan'          => $request->input('angkatan'),
                    'cv'                => $link_cv,
                    'khs'               => $link_khs,
                    'ktm'               => $link_ktm
                ]
            );
            $pilihan = $request->input('pilihan');
            foreach ($pilihan as $key => $value) {
                PenilaianAsprak::create(
                    [
                        'calon_asprak_id'   => $id->id,
                        'mata_kuliah_id'    => $value
                    ]
                );
            }
        });

        return redirect()->route('home');
    }
}
