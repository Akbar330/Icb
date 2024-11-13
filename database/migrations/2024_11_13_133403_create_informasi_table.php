<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul pengumuman
            $table->text('konten'); // Isi atau konten pengumuman
            $table->string('penulis'); // Nama penulis pengumuman
            $table->date('tanggal'); // Tanggal pengumuman
            $table->string('gambar')->nullable(); // Kolom untuk gambar (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi');
    }
}
