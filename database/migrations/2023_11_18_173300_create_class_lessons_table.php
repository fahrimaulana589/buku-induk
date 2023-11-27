<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('class_lessons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_id');
            $table->foreignId('lesson_id');
            $table->foreignId('teacher_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_lessons');
    }
};
