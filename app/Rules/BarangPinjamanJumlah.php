<?php

namespace App\Rules;

use App\Models\Inventaris;
use Illuminate\Contracts\Validation\Rule;

class BarangPinjamanJumlah implements Rule
{
    private $kode;
    private $value;
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
        $this->value = $value;
        return $this->kode != null and $value <= $this->kode->peminjaman and $value < 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = 'Tidak ada';
        if (!is_null($this->kode)) {
            $message = 'Stok tersisa' . $this->kode->peminjaman;
        }

        if ($this->value <= 0) {
            $message = 'Minimal 1';
        }

        return $message;
    }
}
