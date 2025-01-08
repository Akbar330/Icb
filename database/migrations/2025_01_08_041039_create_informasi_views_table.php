<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('informasi_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('informasi_id');
            $table->string('ip_address');
            $table->timestamps();

            // Relasi ke tabel informasis
            $table->foreign('informasi_id')->references('id')->on('informasi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('informasi_views');
    }

};
