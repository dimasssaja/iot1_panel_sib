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
        Schema::create('lamps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->enum('mode', ['CUSTOM', 'MANUAL', 'SCHEDULE', 'LIGHT_SENSOR']);
            $table->enum('lamp_type', ['RGB', 'DIMMABLE', 'SWITCH']);
            $table->boolean('status')->default(false);
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamps');
    }
};
