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
        Schema::table('hasil_votes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_polling')->after('id')->nullable();
            $table->foreign('id_polling')->references('id')->on('master_pollings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_votes', function (Blueprint $table) {
            $table->dropForeign(['id_polling']);
            $table->dropColumn('id_polling');
        });
    }
};
