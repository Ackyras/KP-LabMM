<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormRuanganRequest extends FormRequest
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
            'nama_peminjam'         => ['required', 'max:255', 'regex:/^[a-zA-z]+([\s][a-zA-Z]+)*$/'],
            'nim'                   => ['required', 'numeric'],
            'email'                 => ['email', 'required'],
            'no_hp'                 => ['required', 'digits_between:10,13'],
            'afiliasi'              => ['required'],
            'ruang_lab'             => ['required', Rule::exists('ruang_labs', 'id')],
            'mata_kuliah'           => ['required'],
            'kode_matkul'           => ['required'],
            'dosen'                 => ['required'],
            'waktu'                 => ['required', 'in:07:00:00,09:00:00,13:00:00,15:00:00'],
            'hari'                  => ['in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu', 'required'],
            'keterangan'            => ['required']
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
            'no_hp.digits_between'                  => 'Mohon isi field dengan angka 0-9, minimal 10 dan maksimal 13 angka',
            'afiliasi.required'                     => 'Mohon isi field Afiliasi',
            'ruang_lab.required'                    => 'Mohon pilih ruangan lab',
            'mata_kuliah.required'                  => 'Mohon isi field mata kuliah',
            'kode_matkul.required'                  => 'Mohon isi field kode mata kuliah',
            'dosen.required'                        => 'Mohon isi field dosen',
            'waktu.required'                        => 'Mohon pilih waktu ruangan',
            'hari.required'                         => 'Mohon pilih hari ruangan',
            'waktu.in'                              => 'Pilih waktu antara 07:00, 09:00, 13:00, atau 15:00',
            'hari.in'                               => 'Pilih hari dari Senin sampai Minggu',
            'keterangan.required'                   => 'Mohon isi field keterangan'
        ];
    }
}
