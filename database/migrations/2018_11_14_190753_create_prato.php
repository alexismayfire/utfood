<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pratos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('descricao');
            $table->integer('tipo_cozinha');
            $table->integer('cardapio');
            $table->decimal('preco');
            # TODO: colocar ImageField para a foto
            $table->timestamps();

            $table->foreign('tipo_cozinha')
                ->references('id')
                ->on('tipo_cozinha')
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
        Schema::dropIfExists('pratos');
    }
}
