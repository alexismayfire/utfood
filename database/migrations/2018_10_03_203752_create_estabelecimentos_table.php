<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstabelecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('dono');
            $table->text('descricao');
            $table->string('endereco');
            $table->string('telefone');
            $table->integer('tipo_cozinha_id');
            $table->timestamps();

            $table->foreign('dono')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('tipo_cozinha_id')
                ->references('id')
                ->on('tipo_cozinha')
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
        Schema::dropIfExists('estabelecimentos');
    }
}
