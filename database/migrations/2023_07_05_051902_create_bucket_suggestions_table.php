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
        Schema::create('bucket_suggestions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bucket_id')->nullable();
            $table->foreignId('ball_id')->nullable();
            $table->bigInteger('ball_qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bucket_suggestions');
    }
};
