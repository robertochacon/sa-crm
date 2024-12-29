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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->foreign('frequency_id')->references('id')->on('frequencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
