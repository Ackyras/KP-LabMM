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
            'afiliasi'              => ['required', 'string'],
            'ruang_lab'             => ['required', 'string'],
            'mata_kuliah'           => ['required', 'string'],
            'kode_matkul'           => ['required', 'string'],
            'dosen'                 => ['required', 'string'],
            'waktu'                 => ['required'],
            'hari'                  => ['in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu', 'required'],
        ];
    }
}
