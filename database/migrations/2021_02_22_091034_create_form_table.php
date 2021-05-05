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
            $table->date("tanggal_peminjaman");
            $table->date("tanggal_pengembalian");
            $table->string("keperluan")->nullable();
            $table->string("tempat")->nullable();
            $table->integer("validasi")->default("1");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
