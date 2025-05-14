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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_1_id')->constrained('lectures');
            $table->foreignId('lecture_2_id')->constrained('lectures');
            $table->foreignId('academic_calendar_id')->constrained();
            $table->time('session_started');
            $table->time('session_ended');
            $table->foreignId('room_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
