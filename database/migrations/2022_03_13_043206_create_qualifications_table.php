<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_users_id')->unsigned(); //Foranea con tabla de usuarios Rol Docentes
            $table->unsignedBigInteger('student_users_id')->unsigned(); //Foranea con tabla de usuarios Rol Estudiantes
            $table->tinyInteger('status')->default(1)->comment('0 Inactivo | 1 Activo');
            $table->timestamps();

            $table->foreign('teacher_users_id')->references('id')->on('teacher_subjects')->nullable(false); 
            $table->foreign('student_users_id')->references('id')->on('student_subjects')->nullable(false); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualifications');
    }
}
