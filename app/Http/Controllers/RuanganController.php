<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRuanganRequest;
use App\Models\FormRuangan;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use App\Models\RuangLab;
use App\Rules\PeminjamanRuangan as RulesPeminjamanRuangan;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    protected $array = array();

    public function index()
    {
        $master = "peminjaman";
        $ruangs = RuangLab::paginate(5);
        return view('ruangan.index', compact('ruangs', 'master'));
    }

    public function jadwal($slug)
    {
        $master = "peminjaman";
        $id = RuangLab::where('slug', $slug)->first()->id;
        $this->array = $this->getJadwal($slug, $id);
        $jadwal = $this->array;
        $ruanglabs = RuangLab::all();
        $ruangans = Ruangan::where('ruang_lab', $id)->get();
        $form = FormRuangan::where('validasi', 0)->where('ruang_lab', $id)->pluck('id')->toArray();
        $peminjams = PeminjamanRuangan::with('formruangan')
            ->whereIn('form_ruangan_id', $form)
            ->get();
        $ruang = RuangLab::where('slug', $slug)->first();
        return view('ruangan.jadwal', compact('ruanglabs', 'master', 'peminjams', 'ruangans', 'jadwal', 'ruang'));
    }

    public function form()
    {
        $ruangs = RuangLab::where('status', 'Baik')->get();
        $master = "peminjaman";
        return view('ruangan.form', compact('ruangs', 'master'));
    }

    public function store(FormRuanganRequest $request)
    {
        $minggu = $request->input('minggu');
        DB::transaction(function () use ($request, $minggu) {
            $peminjam = FormRuangan::create($request->validated());
            $request->validate(
                ['minggu'           => ['required', new RulesPeminjamanRuangan($request->get('minggu'), $request->get('hari'), $request->get('waktu'), $request->get('ruang_lab'))]],
                ['minggu.required'  => 'Pilih minimal 1']
            );
            foreach ($minggu as $key => $value) {
                $ruangan = Ruangan::where('ruang_lab', $request->get('ruang_lab'))
                    ->where('waktu', $peminjam->waktu)
                    ->where('hari', $peminjam->hari)
                    ->where('minggu', $value)->pluck('id')->first();

                PeminjamanRuangan::create([
                    'form_ruangan_id'   => $peminjam->id,
                    'ruangan_id'        => $ruangan,
                    'minggu'            => $value
                ]);
            }
        });
        return redirect()->route('ruangan.form')->with('status', 'Berhasil meminjam ruangan, silahkan ikuti alur selanjutnya');
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
