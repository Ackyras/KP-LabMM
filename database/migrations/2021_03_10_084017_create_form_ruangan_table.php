<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nim');
            $table->string('email');
            $table->string('no_hp');
            $table->string('afiliasi');
            $table->string('ruang_lab');
            $table->string('mata_kuliah');
            $table->string('kode_matkul');
            $table->string('dosen');
            $table->time('waktu');
            $table->string('hari');
            $table->integer('validasi')->default('1');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_ruangan');
    }
}
