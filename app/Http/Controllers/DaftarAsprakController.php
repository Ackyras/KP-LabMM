<?php

namespace App\Http\Controllers;

use App\Models\CalonAsprak;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaftarAsprakController extends Controller
{
    public function index()
    {
        $pembukaan = PembukaanAsprak::latest()->first();
        $matakuliahs = MataKuliah::with('daftarmatakuliah')->where('pembukaan_asprak_id', $pembukaan->id)->get();
        return view('asprak.index', compact('matakuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama'          => ['required'],
                'nim'           => ['required', 'regex:/[0-9]+/', 'min:8', 'max:9'],
                'email'         => ['required', 'email'],
                'tanggal_lahir' => ['required', 'date'],
                'program_studi' => ['required'],
                'angkatan'      => ['required', 'regex:/[0-9]+/'],
                'cv'            => ['mimes:pdf,jpeg,png,jpg', 'max:512'],
                'khs'           => ['mimes:pdf,jpeg,png,jpg', 'max:512'],
                'ktm'           => ['mimes:pdf,jpeg,png,jpg', 'max:512'],
                'pil1'          => ['required'],
                'pil2'          => ['nullable'],
                'pil3'          => ['nullable']
            ]
        );

        if ($request->hasFile('cv') and $request->hasFile('khs') and $request->hasFile('ktm')) {
            $cv = $request->file('cv');
            $khs = $request->file('khs');
            $ktm = $request->file('ktm');
            $path = 'public/calon/' . $request->input('nim');

            $storecv = $cv->storeAs($path, $cv->getClientOriginalName() . '.' . $cv->getClientOriginalExtension());
            $storekhs = $khs->storeAs($path, $khs->getClientOriginalName() . '.' . $khs->getClientOriginalExtension());
            $storektm = $ktm->storeAs($path, $ktm->getClientOriginalName() . '.' . $ktm->getClientOriginalExtension());

            $link_cv = $request->root() . 'storage/calon/' . $request->input('nim') . '/' . $cv->getClientOriginalName() . '.' . $cv->getClientOriginalExtension();
            $link_khs = $request->root() . 'storage/calon/' . $request->input('nim') . '/' . $khs->getClientOriginalName() . '.' . $khs->getClientOriginalExtension();
            $link_ktm = $request->root() . 'storage/calon/' . $request->input('nim') . '/' . $ktm->getClientOriginalName() . '.' . $ktm->getClientOriginalExtension();

            $cv = Storage::url($storecv);
            $khs = Storage::url($storekhs);
            $ktm = Storage::url($storektm);
        }

        CalonAsprak::create(
            [
                'nama'              => $request->input('nama'),
                'nim'               => $request->input('nim'),
                'email'             => $request->input('email'),
                'tanggal_lahir'     => $request->input('tanggal_lahir'),
                'program_studi'     => $request->input('program_studi'),
                'angkatan'          => $request->input('angkatan'),
                'cv'                => $link_cv,
                'khs'               => $link_khs,
                'ktm'               => $link_ktm,
                'pil1'              => $request->input('pil1'),
                'pil2'              => $request->input('pil2'),
                'pil3'              => $request->input('pil3'),
            ]
        );

        return redirect()->route('home');
    }
}
