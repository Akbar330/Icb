<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('deskripsi');
            $table->text('konten');
            $table->string('gambar')->nullable(); // Menambahkan kolom gambar
            $table->int('view');
            $table->string('ipaddress');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikels');
    }
}
