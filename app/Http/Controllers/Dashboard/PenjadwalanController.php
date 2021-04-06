<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with('peminjamanruangans')->get();
        return view('dashboard.penjadwalan.index', compact('ruangans'));
    }

    public function destroy($id)
    {
        Ruangan::where('id', $id)->update([
            'status'    => 0
        ]);
        PeminjamanRuangan::where('ruangan_id', $id)->delete();

        $ruangans = Ruangan::with('peminjamanruangans')->get();
        return redirect()->route('penjadwalan.index');
    }

    public function massReset()
    {
        Ruangan::where('status', 1)->update(['status' => 0]);
        return redirect()->route('penjadwalan.index');
    }
}
