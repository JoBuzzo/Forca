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
        Schema::create('category_word', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('category_id');
            
            $table->unsignedBigInteger('word_id');

            $table->foreign('category_id')->references('id')->on('categories');
            
            $table->foreign('word_id')->references('id')->on('words');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_word');
    }
};
