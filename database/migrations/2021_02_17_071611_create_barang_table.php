<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string("kd_barang")->unique();
            $table->string("nama_barang");
            $table->string("foto");
            $table->string("lokasi");
            $table->string("kategori");
            $table->integer("stok");
            $table->integer("peminjaman");
            $table->string("status");
            $table->date("masuk_barang");
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
