<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('password');
            $table->unsignedBigInteger('rols_id')->unsigned()->default(3); //Foranea con tabla de roles - Por defecto queda en 3 para que se registren solo estudianes
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rols_id')->references('id')->on('rols')->nullable(false); 
        });

        //Insertamos los datos necesarios para el manejo de los usuarios
        // Password por defecto 1234abcd
        $roles = array(
            [
                'name' => 'Admin', 
                'email' => 'admin@colint.com', 
                'password' => '$2y$10$/FqRBsNyDXFfCGZIxAndie4E7DBSFZdF6sRanFvanBV7nNnJqjKa.',
                'rols_id' => 1
            ],
            [
                'name' => 'Docente', 
                'email' => 'docente@colint.com', 
                'password' => '$2y$10$/FqRBsNyDXFfCGZIxAndie4E7DBSFZdF6sRanFvanBV7nNnJqjKa.',
                'rols_id' => 2
            ],
            [
                'name' => 'Estudiante', 
                'email' => 'estudiante@colint.com', 
                'password' => '$2y$10$/FqRBsNyDXFfCGZIxAndie4E7DBSFZdF6sRanFvanBV7nNnJqjKa.',
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
