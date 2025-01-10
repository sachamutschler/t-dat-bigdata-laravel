<?php

declare(strict_types=1);

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
        Schema::create('crypto_entities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->decimal('price', 18, 8);
            $table->decimal('market_cap', 18, 8)->nullable();
            $table->decimal('volume', 18, 8)->nullable();
            $table->decimal('change_1h', 10, 8)->nullable();
            $table->decimal('change_24h', 10, 8)->nullable();
            $table->decimal('change_7d', 10, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_entities');
    }
};
