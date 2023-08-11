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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(false);
            $table->string('description', 500)->nullable(false);
            $table->string('link', 1000)->nullable(false);
            $table->tinyInteger('source')->nullable(false)->default(0);
            $table->text('content')->nullable(false);
            $table->integer('score_time')->nullable(false)->default(0);
            $table->integer('score_click')->nullable(false)->default(0);
            $table->integer('score_like')->nullable(false)->default(0);
            $table->integer('score_hot')->nullable(false)->default(0);
            $table->boolean('is_new')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
