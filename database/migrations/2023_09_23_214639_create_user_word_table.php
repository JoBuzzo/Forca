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
        Schema::create('user_word', function (Blueprint $table) {
            
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('word_id');

            $table->integer('score')->default(10);

            $table->boolean('finalized')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');

            $table->primary(['user_id', 'word_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_word');
    }
};
