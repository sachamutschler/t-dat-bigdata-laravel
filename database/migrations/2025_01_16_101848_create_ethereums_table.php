<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ethereums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->decimal('price');
            $table->decimal('market_cap');
            $table->decimal('volume');
            $table->decimal('change_1h');
            $table->decimal('change_24h');
            $table->decimal('change_7d');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ethereums');
    }
};
