<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_dropouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_year_id');
            $table->foreignId('student_id');
            $table->enum('semester',['ganjil','genap']);
            $table->string('reason');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_dropouts');
    }
};
