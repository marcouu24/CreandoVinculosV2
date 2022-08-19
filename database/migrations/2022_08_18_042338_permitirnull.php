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
        Schema::table('centros', function (Blueprint $table) {

            $table->string('nombre')->nullable()->change();;
            $table->string('direccion')->nullable()->change();;
            $table->string('sector')->nullable()->change();;
            $table->string('representante')->nullable()->change();;
            $table->string('correo')->nullable()->change();;
 
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
