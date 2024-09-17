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
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->string('symbol'); // Short name (e.g., BTC)
            $table->string('name'); // Full name (e.g., Bitcoin)
            $table->decimal('price', 15, 2); // Current price
            $table->decimal('market_cap', 20, 2); // Market cap
            $table->decimal('volume_24h', 20, 2); // Volume in the last 24 hours
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coins');
    }
};
