<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'nama_peminjam'         => ['required', 'max:255'],
            'nim'                   => ['required', 'regex:/[0-9]+/', 'min:8'],
            'email'                 => ['email', 'required'],
            'no_hp'                 => ['max:13', 'required', 'regex:/[0-9]+/', 'min:10'],
            'afiliasi'              => ['required'],
            'ruang_lab'             => ['required'],
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
