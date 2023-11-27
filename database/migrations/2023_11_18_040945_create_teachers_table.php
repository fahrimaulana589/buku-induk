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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->bigInteger('nuptk');
            $table->bigInteger('nip');
            $table->string('position');
            $table->string('level');
            $table->string('gender');
            $table->string('religion');
            $table->text('address');
            $table->string('phone');
            $table->string('education');
            $table->string('status');
            $table->date('work_start_date');
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
        Schema::dropIfExists('teachers');
    }
};
