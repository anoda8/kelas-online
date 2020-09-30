<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglMasukToKelasonlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelasonline', function (Blueprint $table) {
            $table->dateTime('wkt_masuk');
            $table->dateTime('wkt_selesai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelasonline', function (Blueprint $table) {
            //
        });
    }
}
