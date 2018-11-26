<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavorito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario');
            $table->integer('tipos_conteudo');
            $table->timestamps();

            $table->foreign('usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('tipos_conteudo')
                ->references('id')
                ->on('tipos_conteudo')
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
        Schema::dropIfExists('favoritos');
    }
}
