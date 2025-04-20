<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id(); //Define la columna como la clave primaria, al marcarla con "id" se especifica que es un int con auto increment por defecto
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->boolean('completada')->default(false);
            $table->timestamps(); //Esta funcion crea automaticamente las tablas "created at" y "updated at"
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
