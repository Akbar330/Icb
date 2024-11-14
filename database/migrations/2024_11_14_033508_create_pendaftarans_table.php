<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->text('alamat');
            $table->date('ttl');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->string('email')->unique();
            $table->string('asal_sekolah');
            $table->enum('jalur_pendaftaran', ['Reguler', 'RMP']);
            $table->string('jurusan');
            $table->string('no_hp');
            $table->enum('abk', ['Y', 'N']);
            $table->string('nama_ortu_wali');
            $table->text('alamat_wali');
            $table->string('pekerjaan_wali');
            $table->string('no_hp_wali');
            $table->enum('mgm', ['Y', 'N']);
            $table->string('nama_mgm')->nullable();
            $table->string('asal_mgm')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
}
