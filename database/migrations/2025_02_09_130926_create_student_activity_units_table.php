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
        Schema::create('student_activity_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // Untuk URL SEO-friendly
            $table->text('description')->nullable();
            $table->string('logo')->nullable(); // Logo UKM
            $table->string('banner')->nullable(); // Banner UKM
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('goals')->nullable();
            $table->unsignedBigInteger('head_id'); // Ketua UKM
            $table->unsignedBigInteger('supervisor_id'); // Dosen pembina
            $table->unsignedBigInteger('created_by'); // Dibuat oleh (admin/dosen)
            $table->timestamps();
            $table->softDeletes();

            // Index untuk optimasi query
            $table->index(['name', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_activity_units');
    }
};
