<?php

namespace App\Rules;

use App\Models\Ruangan;
use Illuminate\Contracts\Validation\Rule;

class PeminjamanRuangan implements Rule
{
    protected $minggu;
    protected $hari;
    protected $waktu;
    protected $ruang;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minggu, $hari, $waktu, $ruang)
    {
        $this->minggu = $minggu;
        $this->hari = $hari;
        $this->waktu = $waktu;
        $this->ruang = $ruang;
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
        $kosong = true;
        $ruangan = Ruangan::where('ruang_lab', $this->ruang)
            ->where('waktu', $this->waktu)
            ->where('hari', $this->hari)
            ->get();
        foreach ($ruangan as $ruang) {
            foreach ($this->minggu as $key => $value) {
                if ($ruang->minggu == $value and $ruang->status == 1)
                    $kosong = false;
            }
        }
        return $kosong;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Jadwal telah di isi, silahkan cek jadwal ruangan untuk melihat.';
    }
}
