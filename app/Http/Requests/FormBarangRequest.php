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
            'nama_peminjam'         => ['required', 'max:255', 'regex:/^(\w+ ?)*$/'],
            'nim'                   => ['required', 'numeric'],
            'email'                 => ['email', 'required'],
            'no_hp'                 => ['required', 'digits_between:10,13'],
            'afiliasi'              => ['required'],
            'tanggal_peminjaman'    => ['date', 'after_or_equal:today'],
            'tanggal_pengembalian'  => ['date', 'after_or_equal:tanggal_peminjaman'],
            'keperluan'             => ['required'],
            'tempat'                => ['required'],
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
            'nama_peminjam.regex'                   => 'Mohon isi nama dengan karakter alfabet',
            'nim.required'                          => 'Mohon isi field NIM/NIP anda',
            'nim.numeric'                           => 'Mohon isi field dengan angka 0-9',
            'email.required'                        => 'Mohon isi field Email',
            'email.email'                           => 'Mohon masukkan email dengan format yang tepat',
            'no_hp.required'                        => 'Mohon isi field No HP',
            'no_hp.digits_between'                  => 'Mohon isi field dengan angka 0-9, minimal 10 dan maksimal 13 ankga',
            'afiliasi.required'                     => 'Mohon isi field Afiliasi',
            'keperluan.required'                    => 'Mohon isi field keperluan',
            'tampat.required'                       => 'Mohon isi field tempat kegiatan',
            'tanggal_peminjaman.required'           => 'Mohon isi field Tanggal Peminjaman',
            'tanggal_peminjaman.date'               => 'Mohon isi field Tanggal Peminjaman dengan tanggal',
            'tanggal_peminjaman.after_or_equal'     => 'Mohon isi field Tanggal Peminjaman tidak bisa sebelum hari ini',
            'tanggal_pengembalian.required'         => 'Mohon isi field Tanggal Pengembalian',
            'tanggal_pengembalian.after_or_equal'   => 'Mohon isi field Tanggal Pengembalian sama atau setalah Tanggal Peminjaman',
        ];
    }
}
