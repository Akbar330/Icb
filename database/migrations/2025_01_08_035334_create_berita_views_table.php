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
        Schema::create('berita_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('berita_id');
            $table->string('ip_address');
            $table->timestamps();

            // Relasi ke tabel beritas
            $table->foreign('berita_id')->references('id')->on('beritas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('berita_views');
    }

};
