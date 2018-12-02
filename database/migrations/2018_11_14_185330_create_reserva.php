<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario');
            $table->integer('cardapio');
            $table->dateTime('data');
            $table->boolean('status')->default('true');
            $table->boolean('comparecimento')->default('false');
            $table->integer('pontos_gerados')->nullable(true);
            $table->timestamps();

            $table->foreign('usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('cardapio')
                ->references('id')
                ->on('cardapios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
