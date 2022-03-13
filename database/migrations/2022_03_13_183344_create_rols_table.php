<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->id();
            $table->char('name', 100)->nullable(false);
            $table->tinyInteger('status')->default(1)->comment('0 Inactivo | 1 Activo');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

         //Insertamos los datos necesarios para el manejo de roles
         $roles = array(['id' => 1,'name' => 'Admin',],
                        ['id' => 2,'name' => 'Docente',],
                        ['id' => 3,'name' => 'Estudiante',]);

            for ($i=0; $i < count($roles); $i++) { 
                DB::table("rols")
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
        Schema::dropIfExists('rols');
    }
}
