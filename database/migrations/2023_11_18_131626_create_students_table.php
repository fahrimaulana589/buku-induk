<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mother_id');
            $table->foreignId('father_id');
            $table->foreignId('class_id');
            $table->integer('nis');
            $table->string('name');
            $table->enum('status',['active','dropout','graduate']);
            $table->string('photo');
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion');
            $table->string('citizenship');
            $table->integer('fam_order');
            $table->integer('fam_count');
            $table->string('fam_status');
            $table->string('language');
            $table->text('address');
            $table->string('phone');
            $table->string('live_with');
            $table->string('blood_type');
            $table->integer('height');
            $table->integer('weight');
            $table->string('hobby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
