<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsAndIpAddressesToberitasTable extends Migration
{
    public function up()
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
        });
    }

    public function down()
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('views');

        });
    }
}
