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
            $table->enum('day',[0,1,2,3,4,5]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_lessons');
    }
};
