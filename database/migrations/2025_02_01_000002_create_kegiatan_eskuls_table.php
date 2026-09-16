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
        Schema::create('kegiatan_eskuls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eskul_id')->constrained('eskuls')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug');
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_eskuls');
    }
};
