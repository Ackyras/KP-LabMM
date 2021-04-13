<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FormRuangan;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use App\Models\RuangLab;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    protected $array = array();

    public function index($slug)
    {

        $id = RuangLab::where('slug', $slug)->first()->id;
        $this->array = $this->getJadwal($slug, $id);
        $jadwal = $this->array;
        $ruanglabs = RuangLab::all();
        $ruangans = Ruangan::where('ruang_lab', $id)->get();
        $form = FormRuangan::where('validasi', 0)->pluck('id')->toArray();
        $peminjams = PeminjamanRuangan::with('formruangan')
            ->whereIn('form_ruangan_id', $form)
            ->get();
        return view('dashboard.penjadwalan.index', compact('jadwal', 'ruanglabs', 'ruangans', 'peminjams', 'slug', 'id'));
    }

    public function destroy(Request $request, $id)
    {
        $slug = $request->get('slug');
        Ruangan::where('id', $id)->update([
            'status'    => 0
        ]);
        $data = Ruangan::where('id', $id)->first();
        return redirect()->route('penjadwalan.index', $slug)->with('status', 'Jadwal hari ' . $data->hari . ' pukul ' . $data->waktu . ' minggu ' . $data->minggu . ' berhasil dihapus.');
    }

    public function massReset(Request $request, $id)
    {
        $slug = $request->get('slug');
        Ruangan::where('ruang_lab', $id)->where('status', 1)->update(['status' => 0]);
        return redirect()->route('penjadwalan.index', $slug)->with('status', 'Jadwal berhasil direset');
    }

    /**
     * Get Jadwal
     * 
     * @param $slug
     * @return array
     */
    public function getJadwal($slug, $id)
    {
        $array = array();
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Senin')
            ->where('waktu', '07:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Selasa')
            ->where('waktu', '07:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Rabu')
            ->where('waktu', '07:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Kamis')
            ->where('waktu', '07:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Jumat')
            ->where('waktu', '07:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Sabtu')
            ->where('waktu', '07:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Minggu')
            ->where('waktu', '07:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Senin')
            ->where('waktu', '09:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Selasa')
            ->where('waktu', '09:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Rabu')
            ->where('waktu', '09:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Kamis')
            ->where('waktu', '09:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Jumat')
            ->where('waktu', '09:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Sabtu')
            ->where('waktu', '09:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Minggu')
            ->where('waktu', '09:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Senin')
            ->where('waktu', '13:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Selasa')
            ->where('waktu', '13:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Rabu')
            ->where('waktu', '13:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Kamis')
            ->where('waktu', '13:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Jumat')
            ->where('waktu', '13:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Sabtu')
            ->where('waktu', '13:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Minggu')
            ->where('waktu', '13:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Senin')
            ->where('waktu', '15:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Selasa')
            ->where('waktu', '15:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Rabu')
            ->where('waktu', '15:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Kamis')
            ->where('waktu', '15:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Jumat')
            ->where('waktu', '15:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Sabtu')
            ->where('waktu', '15:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        $ruangans = Ruangan::where('ruang_lab', $id)
            ->where('hari', 'Minggu')
            ->where('waktu', '15:00:00')
            ->get()
            ->toArray();
        array_push($array, $ruangans);
        return $array;
    }
}
