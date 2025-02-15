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
        Schema::create('proposal_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users'); // Relasi ke mahasiswa
            $table->foreignId('supervisor_id')->constrained('users'); // Relasi ke dosen pembimbing
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('document_path'); // Path file proposal (PDF)
            $table->enum('status', ['pending', 'approved', 'rejected', 'revised'])->default('pending');
            $table->text('feedback')->nullable(); // Feedback dari dosen
            $table->date('scheduled_date')->nullable(); // Tanggal ujian proposal
            $table->time('scheduled_time')->nullable(); // Waktu ujian proposal
            $table->string('room')->nullable(); // Ruang ujian
            $table->foreignId('created_by')->constrained('users'); // Dibuat oleh (admin/dosen)
            $table->timestamps();
            $table->softDeletes();

            // Index untuk optimasi query
            $table->index(['student_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_exams');
    }
};
