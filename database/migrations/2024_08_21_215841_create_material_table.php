<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * 1. Código: deve ser único
     * 2. Descrição
     * 3. Quantidade em estoque
     * 4. Valor/Preço
     * 5. Data atualização
     * 6. Data inclusão
     * 7. Status de disponibilidade: 1. Disponível | 0. Indisponível
     */
    public function up(): void
    {
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', length: 50)->unique();
            $table->string('descricao', length: 255);
            $table->integer('estoque')->nullable($value = true);
            $table->decimal('valor', total: 10, places: 2)->nullable($value = true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable($value = true);
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material');
    }
};
