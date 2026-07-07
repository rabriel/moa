<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_store_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->timestamp('visited_at')->nullable();
            $table->timestamps();
            $table->unique(['player_id', 'store_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_store_visits');
    }
};
