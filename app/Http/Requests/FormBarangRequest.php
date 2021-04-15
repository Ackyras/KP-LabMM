<?php

namespace App\Http\Requests;

use App\Rules\BarangPinjamanJumlah;
use App\Rules\BarangPinjaman;
use Illuminate\Foundation\Http\FormRequest;

class FormBarangRequest extends FormRequest
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
            'nama_peminjam'         => ['required', 'max:255'],
            'nim'                   => ['required', 'regex:/[0-9]+/', 'min:8'],
            'email'                 => ['email', 'required'],
            'no_hp'                 => ['max:13', 'required', 'regex:/[0-9]+/', 'min:10'],
            'afiliasi'              => ['required'],
            'tanggal_peminjaman'    => ['date', 'after_or_equal:today'],
            'tanggal_pengembalian'  => ['date', 'after_or_equal:tanggal_peminjaman'],
            'kode1'                 => ['required', new BarangPinjaman($this->request->get('kode1'))],
            'jumlah1'               => [new BarangPinjamanJumlah($this->request->get('kode1')), 'min:1'],
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
            'nama_peminjam.required'                => 'Mohon isi field Nama anda',
            'nim.required'                          => 'Mohon isi field NIM/NIP anda',
            'nim.regex'                             => 'Mohon isi field dengan angka 0-9',
            'nim.min'                               => 'NIM/NIP minimal 8 angka',
            'email.required'                        => 'Mohon isi field Email',
            'email.email'                           => 'Mohon masukkan email dengan format yang tepat',
            'no_hp.max'                             => 'No HP maksimal 13 angka',
            'no_hp.min'                             => 'No HP minimal 10 angka',
            'no_hp.required'                        => 'Mohon isi field No HP',
            'no_hp.regex'                           => 'Mohon isi field dengan angka 0-9',
            'afiliasi.required'                     => 'Mohon isi field Afiliasi',
            'tanggal_peminjaman.required'           => 'Mohon isi field Tanggal Peminjaman',
            'tanggal_peminjaman.date'               => 'Mohon isi field Tanggal Peminjaman dengan tanggal',
            'tanggal_pengembalian.required'         => 'Mohon isi field Tanggal Pengembalian',
            'tanggal_pengembalian.after_or_equal'   => 'Mohon isi field Tanggal Pengembalian sama atau setalah Tanggal Peminjaman',
            'kode1.required'                        => 'Pilih barang',
            'jumlah1.min'                           => 'Minimum 1'
        ];
    }
}
