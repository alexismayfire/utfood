<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvalicao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario');
            $table->integer('estrelas');
            $table->integer('tipo_conteudo');
            $table->string('comentario');
            $table->timestamps();

            $table->foreign('usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('tipo_conteudo')
                ->references('id')
                ->on('tipo_conteudo')
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
        Schema::dropIfExists('avaliacoes');
    }
}
