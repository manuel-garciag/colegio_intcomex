<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->unsigned(); //Foranea con tabla de usuarios
            $table->unsignedBigInteger('subjects_id')->unsigned(); //Foranea con tabla de asignaturas
            $table->tinyInteger('status')->default(1)->comment('0 Inactivo | 1 Activo');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->nullable(false); 
            $table->foreign('subjects_id')->references('id')->on('subjects')->nullable(false); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_subjects');
    }
}
