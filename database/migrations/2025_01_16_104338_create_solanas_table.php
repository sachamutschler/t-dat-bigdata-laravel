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
            $table->decimal('price', 20, 8);
            $table->decimal('market_cap', 20, 8)->nullable();
            $table->decimal('volume', 20, 8)->nullable();
            $table->string('change_1h', 10, 8)->nullable();
            $table->string('change_24h', 10, 8)->nullable();
            $table->string('change_7d', 10, 8)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solanas');
    }
};
