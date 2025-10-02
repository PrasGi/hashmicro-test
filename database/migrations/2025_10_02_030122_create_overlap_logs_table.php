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
        Schema::create('overlap_logs', function (Blueprint $table) {
            $table->id();
            $table->text('input_a');
            $table->text('input_b');
            $table->boolean('sensitive')->default(true);
            $table->unsignedTinyInteger('result_pct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overlap_logs');
    }
};
