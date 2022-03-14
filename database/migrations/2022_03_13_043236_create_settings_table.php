<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


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
            $table->integer('id');
            $table->float('nota_minima', 10, 2); // Nota minima con la que aprueban los estudiantes
            $table->integer('num_notas'); // Numero de notas maxima con la que se califica los estudiantes
            $table->tinyInteger('status')->default(1)->comment('0 Inactivo | 1 Activo');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

         //Insertamos los datos de configuracion inicial
         $roles = array([
                'id' => '1',
                'nota_minima' => '3.00',
                'num_notas' => '4',
            ]);

            for ($i=0; $i < count($roles); $i++) { 
                DB::table("settings")
                ->insert($roles[$i]);
            }

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
