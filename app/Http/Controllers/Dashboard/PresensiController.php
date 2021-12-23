<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\QRStoreRequest;
use App\Models\Asprak;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use App\Models\Presensi;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    protected $pembukaan_id;

    public function __construct()
    {
        $this->pembukaan_id = PembukaanAsprak::latest()->first();
    }

    public function daftar()
    {
        $qr = QrCode::with('matakuliah')->orderByDesc('id')->paginate(10);
        $matakuliah = $this->pembukaan_id->matakuliahs;
        // dd($qr);
        return view('dashboard.pendaftaran.presensi.list', compact('qr', 'matakuliah'));
    }

    public function log()
    {
        // $asprak = Asprak::with('presensi')->get();
        $asprak = Asprak::paginate(15);
        return view('dashboard.pendaftaran.presensi.log', compact('asprak'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $asprak = Asprak::with('presensi')->withCount('presensi')->paginate(10);
        // dd($asprak);
        return view('dashboard.pendaftaran.presensi.index', compact('asprak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qr = QrCode::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.pendaftaran.presensi.list', compact('qr'));
        return view('dashboard.pendaftaran.presensi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QRStoreRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            //code...
            $qr = QrCode::create($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return back()->with('error', 'Gagal menambahakan Data');
        }
        return redirect()->route('presensi.list')->with('success', 'Berhasil menambahkan QRCode');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $asprak = Asprak::find($id);
        // dd($asprak->nama);
        return view('dashboard.pendaftaran.presensi.show', compact('asprak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $qr = QrCode::find($id);
        DB::beginTransaction();
        try {
            //code...
            $qr->destroy();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->with('errror', 'Gagal menghapus Data!');
        }
        return back()->with('success', 'Data berhasil dihapus');
    }
}
