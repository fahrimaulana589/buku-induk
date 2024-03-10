<?php

use App\Models\FilamentUser;
use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teacher_users', function (Blueprint $table) {
            $table->foreignIdFor(Teacher::class)->unique();
            $table->foreignIdFor(FilamentUser::class)->unique()->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_users');
    }
};
