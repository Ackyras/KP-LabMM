<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->id();
            $table->string("nama_peminjam");
            $table->string("nim");
            $table->string("email");
            $table->string("no_hp");
            $table->string("afiliasi");
            $table->string("kd_barang_1");
            $table->integer("jumlah_1");
            $table->string("kd_barang_2")->nullable();
            $table->integer("jumlah_2")->nullable();
            $table->string("kd_barang_3")->nullable();
            $table->integer("jumlah_3")->nullable();
            $table->string("kd_barang_4")->nullable();
            $table->integer("jumlah_4")->nullable();
            $table->string("kd_barang_5")->nullable();
            $table->integer("jumlah_5")->nullable();
            $table->date("tanggal_peminjaman");
            $table->date("tanggal_pengembalian");
            $table->integer("validasi")->default("1");
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
        Schema::dropIfExists('form');
    }
}
