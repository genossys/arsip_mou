<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelasiTbmaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  
        Schema::table('tb_arsip', function (Blueprint $table) {
            $table->foreign('username', 'usernamearsip_ifk')->references('username')->on('tb_user')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
        Schema::table('tb_instansi', function (Blueprint $table) {
            $table->foreign('username', 'usernameinstansi_ifk')->references('username')->on('tb_user')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
