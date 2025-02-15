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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Relasi ke mata kuliah
            $table->unsignedBigInteger('lecturer_id'); // Relasi ke dosen
            $table->enum('day', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']); // Hari
            $table->time('start_time'); // Waktu mulai
            $table->time('end_time'); // Waktu selesai
            $table->string('room'); // Ruang kelas
            $table->enum('class_type', ['theory', 'practice'])->default('theory'); // Tipe kelas (teori/praktikum)
            $table->unsignedBigInteger('created_by'); // Dibuat oleh (admin/dosen)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
