<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('$2y$10$/FqRBsNyDXFfCGZIxAndie4E7DBSFZdF6sRanFvanBV7nNnJqjKa.'); // Contraseña por defect es 1234abcd
            $table->unsignedBigInteger('rols_id')->unsigned()->default(3); //Foranea con tabla de roles - Por defecto queda en 3 para que se registren solo estudianes
            $table->rememberToken();
            $table->tinyInteger('status')->default(1)->comment('0 Inactivo | 1 Activo');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('rols_id')->references('id')->on('rols')->nullable(false); 
        });

        //Insertamos los datos necesarios para el manejo de los usuarios
        // Password por defecto 1234abcd
        $roles = array(
            [
                'name' => 'Admin', 
                'email' => 'admin@colint.com', 
                'rols_id' => 1
            ],
            [
                'name' => 'Docente', 
                'email' => 'docente@colint.com', 
                'rols_id' => 2
            ],
            [
                'name' => 'Docente 2', 
                'email' => 'docente2@colint.com', 
                'rols_id' => 2
            ],
            [
                'name' => 'Estudiante', 
                'email' => 'estudiante@colint.com', 
                'rols_id' => 3
            ],
            [
                'name' => 'Estudiante 2', 
                'email' => 'estudiante2@colint.com', 
                'rols_id' => 3
            ]
        );

        for ($i=0; $i < count($roles); $i++) { 
        DB::table("users")
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
        Schema::dropIfExists('users');
    }
}
