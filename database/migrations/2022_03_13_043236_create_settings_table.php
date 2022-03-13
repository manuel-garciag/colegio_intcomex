<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->float('nota_minima', 2, 2); // Nota minima con la que aprueban los estudiantes
            $table->integer('num_notas'); // Numero de notas maxima con la que se califica los estudiantes
            $table->tinyInteger('status')->default(1)->comment('0 Inactivo | 1 Activo');
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
        Schema::dropIfExists('settings');
    }
}
