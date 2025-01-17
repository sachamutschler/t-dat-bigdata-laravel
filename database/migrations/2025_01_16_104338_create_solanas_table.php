<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('solanas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->decimal('price', 38, 8);
            $table->decimal('market_cap', 38, 8)->nullable();
            $table->decimal('volume', 38, 8)->nullable();
            $table->string('change_1h')->nullable();
            $table->string('change_24h')->nullable();
            $table->string('change_7d')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solanas');
    }
};
