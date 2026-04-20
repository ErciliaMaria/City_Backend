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
        Schema::create('ufs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('estado', 100); // Ex: São Paulo, Rio de Janeiro, Ceará
            $table->char('uf', 2)->unique(); // Ex: SP, RJ, CE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ufs');
    }
};
