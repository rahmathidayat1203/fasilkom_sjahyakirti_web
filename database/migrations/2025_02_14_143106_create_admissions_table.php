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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mhs');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('nomor_telepon');
            $table->string('email')->unique();
            $table->string('golongan_darah');
            $table->string('status_pernikahan');
            $table->string('kewarganegaraan');
            $table->string('agama');
            $table->string('alamat_rumah');
            $table->string('ektp')->unique();
            $table->string('foto',);
            $table->string('nama_instansi')->nullable();
            $table->string('alamat_kantor')->nullable();
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_kelas');
            $table->string('status_pendaftaran');
            $table->string('asal_sekolah');
            $table->string('nama_sekolah');
            $table->string('jurusan_sekolah');
            $table->integer('tahun_lulus');
            $table->string('nomor_ijazah');
            $table->string('unggah_ijazah');
            $table->string('unggah_nem');
            $table->string('nama_perguruan_asal')->nullable();
            $table->string('fakultas_asal')->nullable();
            $table->string('jurusan_asal')->nullable();
            $table->string('nim_asal_perkuliahan')->nullable();
            $table->string('ijazah_asal')->nullable();
            $table->string('transkrip_asal')->nullable();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('alamat_ortu');
            $table->string('telpon_ortu')->nullable();
            $table->string('pekerjaan_ortu');
            $table->string('pendapatan_ortu');
            $table->string('penanggung_biaya');
            $table->string('form_pernyataan');
            $table->date('tgl_pernyataan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
