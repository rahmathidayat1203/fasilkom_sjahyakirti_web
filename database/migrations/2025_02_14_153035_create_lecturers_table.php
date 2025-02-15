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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users (1 dosen = 1 user)
            $table->string('nidn')->unique(); // Nomor Induk Dosen Nasional
            $table->string('phone')->nullable(); // Nomor telepon dosen
            $table->text('address')->nullable(); // Alamat dosen
            $table->date('birth_date')->nullable(); // Tanggal lahir
            $table->string('birth_place')->nullable(); // Tempat lahir
            $table->enum('gender', ['male', 'female'])->nullable(); // Jenis kelamin
            $table->string('expertise')->nullable(); // Bidang keahlian
            $table->unsignedBigInteger('faculty_id'); // Relasi ke fakultas (jika ada)
            $table->unsignedBigInteger('program_id'); // Relasi ke program/jurusan (jika ada)
            $table->unsignedBigInteger('created_by'); // Dibuat oleh (admin)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
