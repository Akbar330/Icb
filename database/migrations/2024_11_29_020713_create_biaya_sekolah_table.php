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
    Schema::create('biaya_sekolah', function (Blueprint $table) {
        $table->id();
        $table->string('nama_biaya');
        $table->decimal('jumlah', 15, 2);
        $table->decimal('jumlah_non', 15, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('biaya_sekolah');
}
};
