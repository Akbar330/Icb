<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsAndIpAddressesToArtikelsTable extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
        });
    }

    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropColumn('views');

        });
    }
}
