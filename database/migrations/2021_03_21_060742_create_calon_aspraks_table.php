<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonAspraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_aspraks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('email');
            $table->date('tanggal_lahir');
            $table->string('program_studi');
            $table->integer('angkatan');
            $table->string('cv');
            $table->string('khs');
            $table->string('ktm');
            $table->string('pil1');
            $table->string('pil2');
            $table->string('pil3');
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
        Schema::dropIfExists('calon_aspraks');
    }
}
