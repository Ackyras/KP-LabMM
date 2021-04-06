<?php

namespace App\Http\Requests;

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
            'tanggal_peminjaman'    => ['date'],
            'tanggal_pengembalian'  => ['date', 'after_or_equal:tanggal_peminjaman']
        ];
    }
}
