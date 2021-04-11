<?php

namespace App\Rules;

use App\Models\Inventaris;
use Illuminate\Contracts\Validation\Rule;

class BarangPinjamanJumlah implements Rule
{
    private $kode;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($kode)
    {
        $this->kode = Inventaris::where('nama_barang', $kode)->first();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->kode != null and $value < $this->kode->peminjaman;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ($this->kode != null) ? 'Stok tersisa ' . $this->kode->peminjaman : 'Tidak ada';
    }
}
