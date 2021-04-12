<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StokPeminjamanBarang implements Rule
{
    protected $stok;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($stok)
    {
        $this->stok = $stok;
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
        return $value <= $this->stok;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Barang dipinjam harus sama atau lebih kecil dari stok';
    }
}
