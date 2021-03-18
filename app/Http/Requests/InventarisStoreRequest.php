<?php

namespace App\Http\Requests;

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
            'kd_barang'     => ['required', 'max:255'],
            'nama_barang'   => ['required', 'max:255'],
            'foto'          => ['nullable', 'mimes:jpeg,png,jpg', 'max:1024'],
            'lokasi'        => ['required', 'in:TPB,PRODI'],
            'kategori'      => ['required', 'in:Elektronik,Non Elektronik'],
            'stok'          => ['regex:/[0-9]+/', 'required'],
            'peminjaman'    => ['regex:/[0-9]+/', 'required'],
            'status'        => ['required', 'in:Baik,Tidak Baik'],
            'masuk_barang'  => ['date']
        ];
    }
}
