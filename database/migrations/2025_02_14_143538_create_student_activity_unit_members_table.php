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
        Schema::create('student_activity_unit_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Relasi ke mahasiswa
            $table->unsignedBigInteger('student_activity_unit_id'); // Relasi ke UKM
            $table->enum('role', ['member', 'coordinator', 'head'])->default('member'); // Peran dalam UKM
            $table->date('joined_at'); // Tanggal bergabung
            $table->date('left_at')->nullable(); // Tanggal keluar (jika ada)
            $table->unsignedBigInteger('created_by'); // Dibuat oleh (admin/ketua UKM)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_activity_unit_members');
    }
};
