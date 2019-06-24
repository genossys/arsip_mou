<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_instansi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', '191')->unique()->index();
            $table->string('email', '191')->unique();
            $table->string('noHp', '15');
            $table->text('alamat');
            $table->timestamps();
        });

        Schema::create('tb_arsip', function (Blueprint $table) {
            $table->string('kdArsip', '15')->primary();
            $table->string('judulArsip', '191');
            $table->text('keterangan');
            $table->date('tanggal');
            $table->string('urlFile', '191');
            $table->string('username','15')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_instansi');
        Schema::dropIfExists('tb_arsip');
    }
}
