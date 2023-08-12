<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('oportunidadesprodutos', function (Blueprint $table) {
            $table->id();
            
            //chave estrangeira oportunidade_id
            $table->bigInteger('oportunidade_id')->unsigned();
            $table->foreign('oportunidade_id')->references('id')->on('oportunidades');

            //chave estrangeira user_id (vendedor)
            $table->bigInteger('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos');




            // Obs
            // Poderia ser adicionado o campo inteiro quantidade, representando a quantidade do produto_id que foi escolhida pelo cliente.
            // Para fins de simplificação, não será utilizado o campo quantidade
             


        });



        //Alimenta Cliente, Produto e User com dados fake (Factory)
        //o comando php artisan db:seed foi adicionado aqui para fins de simpificacao para o avaliador
        Artisan::call('db:seed');



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oportunidadesprodutos');
    }
};
