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
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users'); // Relasi ke mahasiswa
            $table->string('nim')->unique(); // Nomor Induk Mahasiswa
            $table->string('phone')->nullable(); // Nomor telepon
            $table->text('address'); // Alamat
            $table->date('birth_date'); // Tanggal lahir
            $table->string('birth_place'); // Tempat lahir
            $table->string('religion')->nullable(); // Agama
            $table->enum('gender', ['male', 'female']); // Jenis kelamin
            $table->string('parent_name')->nullable(); // Nama orang tua
            $table->string('parent_phone')->nullable(); // Nomor telepon orang tua
            $table->foreignId('created_by')->constrained('users'); // Dibuat oleh (admin)
            $table->timestamps();
            $table->softDeletes();

            // Index untuk optimasi query
            $table->index(['nim', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_infos');
    }
};
