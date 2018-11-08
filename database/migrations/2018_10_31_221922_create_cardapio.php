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
            $table->integer('estabelecimento');
            $table->string('nome');
            $table->integer('pontos');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('estabelecimento')
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
        //
    }
}
