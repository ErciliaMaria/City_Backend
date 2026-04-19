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
       Schema::create('cidades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('uf_id')->nullable();
            $table->foreign('uf_id')->references('id')->on('ufs')->onDelete('cascade');
            $table->string('nome');
            $table->string('cep', 9)->nullable();
            $table->integer('ddd')->nullable();
            $table->string('codigo_ibge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cidades');
    }
};
