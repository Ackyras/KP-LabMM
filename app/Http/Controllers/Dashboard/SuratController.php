<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function masuk()
    {
        $surats = Surat::where('kategori', 1)->paginate(10);
        $kategori = '1';
        return view('dashboard.surat.index', compact('surats', 'kategori'));
    }

    public function keluar()
    {
        $surats = Surat::where('kategori', 2)->paginate(10);
        $kategori = '2';
        return view('dashboard.surat.index', compact('surats', 'kategori'));
    }

    public function create()
    {
        return view('dashboard.surat.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'judul'         => ['required', 'max:50'],
                'perihal'       => ['required'],
                'pengirim'      => ['required'],
                'penerima'      => ['required'],
                'nomor'         => ['required'],
                'lokasi'        => ['required'],
                'kategori'      => ['required'],
                'tanggal_masuk' => ['date', 'required'],
                'file'          => ['required', 'max:2048', 'mimes:pdf,doc,docx,zip,rar,xls,xlsx,jpg,jpeg,png']
            ]
        );

        if ($request->hasFile('file')) {
            $folder = uniqid();
            $file = $request->file('file');
            $path = "public/surat/" . $folder;
            $store = $file->storeAs($path, $file->getClientOriginalName());
            $link = $request->root() . '/storage/surat/' . $folder . '/' . $file->getClientOriginalName();
            $file = Storage::url($store);
            $file = $request->root() . $file;
        }

        Surat::create([
            'judul'                 => $request->input('judul'),
            'perihal'               => $request->input('perihal'),
            'pengirim'              => $request->input('pengirim'),
            'penerima'              => $request->input('penerima'),
            'nomor'                 => $request->input('nomor'),
            'lokasi'                => $request->input('lokasi'),
            'kategori'              => $request->input('kategori'),
            'tanggal_masuk'         => $request->input('tanggal_masuk'),
            'file'                  => $link,
        ]);

        return redirect()->route('surat.masuk')->with('status', 'Berhasil menambah surat');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('dashboard.surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'judul'         => ['required', 'max:50'],
                'perihal'       => ['required'],
                'pengirim'      => ['required'],
                'penerima'      => ['required'],
                'nomor'         => ['required'],
                'lokasi'        => ['required'],
                'kategori'      => ['required'],
                'tanggal_masuk' => ['date', 'required'],
                'file'          => ['nullable', 'max:2048', 'mimes:pdf,doc,docx,zip,rar,xls,xlsx,jpg,jpeg,png']
            ]
        );
        $link = '';
        if ($request->hasFile('file')) {
            $folder = uniqid();
            $file = $request->file('file');
            $path = "public/surat/" . $folder;
            $store = $file->storeAs($path, $file->getClientOriginalName());
            $link = $request->root() . '/storage/surat/' . $folder . '/' . $file->getClientOriginalName();
            $file = Storage::url($store);
            $file = $request->root() . $file;
        }

        Surat::where('id', $id)->update(
            [
                'judul'                 => $request->input('judul'),
                'perihal'               => $request->input('perihal'),
                'pengirim'              => $request->input('pengirim'),
                'penerima'              => $request->input('penerima'),
                'nomor'                 => $request->input('nomor'),
                'lokasi'                => $request->input('lokasi'),
                'kategori'              => $request->input('kategori'),
                'tanggal_masuk'         => $request->input('tanggal_masuk'),
                'file'                  => ($link == '') ? $request->input('oldfile') : $link,
            ]
        );

        return redirect()->route('surat.masuk')->with('status', 'Berhasil merubah surat');
    }

    public function destroy($id)
    {
        Surat::where('id', $id)->delete();
        return redirect()->route('surat.masuk')->with('status', 'Berhasil menghapus surat');
    }
}
