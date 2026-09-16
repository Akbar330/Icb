<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eskuls', function (Blueprint $table) {
            $table->id();
            $table->string('nama_eskul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Umum'); // Olahraga, Seni & Budaya, Kepemimpinan, Keagamaan, Akademik/IT
            $table->string('pembina')->nullable();
            $table->string('ketua')->nullable();
            $table->string('jadwal')->nullable(); // contoh: "Jumat, 15.00 - 17.00 WIB"
            $table->string('tempat')->nullable(); // contoh: "Lapangan Utama / Lab Komputer"
            $table->string('foto')->nullable(); // logo / cover utama eskul
            $table->text('deskripsi')->nullable();
            $table->text('visi_misi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eskuls');
    }
};
