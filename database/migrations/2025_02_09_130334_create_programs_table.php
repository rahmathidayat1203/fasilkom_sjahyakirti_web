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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained(); // Relasi langsung ke faculty
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('banner')->nullable();
            $table->text('current_info');
            $table->text('vision');
            $table->text('mission');
            $table->text('goals');
            $table->text('objectives');
            $table->text('head_welcome_message');
            $table->string('head_photo')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
