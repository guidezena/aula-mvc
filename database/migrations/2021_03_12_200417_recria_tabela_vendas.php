<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecriaTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('funcionario_id')->unsigned();
            $table->date('data_da_venda');
            $table->double('valor', 12, 2);
            
            $table->foreign('cliente_id')->references('id')->on('Clientes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
