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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao');
            $table->string('resposta')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('chamado_id_user')->nullable();
            $table->timestamps();

            // Definir a chave estrangeira
             $table->foreign('chamado_id_user')
             ->references('id')
             ->on('users')
             ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
