<?php

namespace App\Rules;

use App\Models\Inventaris;
use Illuminate\Contracts\Validation\Rule;

class BarangPinjaman implements Rule
{
    private $kode;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($kode)
    {
        $this->kode = $kode;
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
        return Inventaris::where('nama_barang', $this->kode)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Barang yang anda pilih tidak ada';
    }
}
