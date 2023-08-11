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
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //chave estrangeira cliente_id
            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            //chave estrangeira user_id (vendedor)
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');



            $table->enum('status', ['pendente', 'aprovada', 'recusada', 'vencida'])->default('pendente');

                      
            


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oportunidades');
    }
};
