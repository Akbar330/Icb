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
        Schema::create('hasil_votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pilihan_id');
            $table->string('session_id')->unique();
            $table->string('ip');
            $table->string('vote_date');
            $table->timestamps();
            $table->foreign('pilihan_id')->references('id')->on('pilihan_votes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_votes');
    }
};
