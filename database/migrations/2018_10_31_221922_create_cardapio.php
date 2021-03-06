<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardapio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardapios', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('estabelecimento_id');
            $table->string('nome');
            $table->integer('pontos');
            $table->boolean('status')->default('true');
            $table->timestamps();

            $table->foreign('estabelecimento_id')
                ->references('id')
                ->on('estabelecimentos')
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
        Schema::dropIfExists('cardapios');
    }
}
