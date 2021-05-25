<?php

namespace App\Http\Requests;

use App\Rules\StokPeminjamanBarang;
use Illuminate\Foundation\Http\FormRequest;

class InventarisStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kd_barang'     => ['required', 'max:255', 'unique:barang,kd_barang'],
            'nama_barang'   => ['required', 'max:255'],
            'foto'          => ['nullable', 'image', 'max:1024'],
            'lokasi'        => ['required', 'in:TPB,PRODI'],
            'kategori'      => ['required', 'in:Elektronik,Non Elektronik'],
            'stok'          => ['numeric', 'required', 'min:0'],
            'peminjaman'    => ['numeric', 'required', new StokPeminjamanBarang($this->request->get('stok'))],
            'status'        => ['required', 'in:Baik,Tidak Baik'],
            'masuk_barang'  => ['date']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'kd_barang.required'    => 'Mohon isi field Kode Barang',
            'kd_barang.unique'       => 'Kode barang sudah digunakan',
            'nama_barang.required'  => 'Mohon isi field Kode Barang',
            'foto.max'              => 'Maksimum file 1 Mb',
            'foto.image'            => 'Mohon masukkan file bertipe gambar',
            'lokasi.required'       => 'Mohon pilih Lokasi barang',
            'kategori.required'     => 'Mohon pilih Kategori barang',
            'stok.required'         => 'Mohon isi field Stok barang',
            'stok.min'              => 'Stok barang minimal 0',
            'peminjaman.required'   => 'Mohon isi field Peminjaman barang',
            'status.required'       => 'Mohon pilih Status barang',
            'numeric'               => 'Masukkan :attribute dengan angka'
        ];
    }
}
