<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        return view('dashboard.inventaris.index');
    }


    public function create()
    {
        return view('dashboard.inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_barang' => ['required', 'max:255'],
            'nama_barang' => ['required', 'max:255'],
            'lokasi' => [Rule::requiredIf($request->input('lokasi') == '0')],
            'kategori' => [Rule::requiredIf($request->input('kategori') == '0')],
            'stok' => [],
            'status' => [Rule::requiredIf($request->input('status') == '0')],
            'masuk_barang' => ['date']
        ])
    }

    public function show($id)
    {
        return view('dashboard.inventaris.show');
    }

    public function edit($id)
    {
        return view('dashboard.inventaris.edit');
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
