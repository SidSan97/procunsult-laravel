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
        Schema::create('historico_chamado', function (Blueprint $table) {
            $table->id();
            $table->string('resposta')->nullable();
            $table->string('nivel');
            $table->unsignedBigInteger('chamado_id')->nullable();
            $table->timestamps();

            // Definir a chave estrangeira
             $table->foreign('chamado_id')
             ->references('id')
             ->on('chamados')
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
