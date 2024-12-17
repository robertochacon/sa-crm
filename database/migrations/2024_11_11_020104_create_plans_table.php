<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('frequency_id')->nullable();
            $table->foreign('frequency_id')->references('id')->on('frequencies');
            $table->unsignedBigInteger('support_id')->nullable();
            $table->foreign('support_id')->references('id')->on('supports');
            $table->decimal('amount', 8, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
