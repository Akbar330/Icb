<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artikel_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artikel_id');
            $table->string('ip_address');
            $table->timestamps();

            // Relasi ke tabel artikels
            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikel_views');
    }

};
