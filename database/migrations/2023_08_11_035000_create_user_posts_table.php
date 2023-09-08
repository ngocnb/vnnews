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
        Schema::create('user_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('post_id')->nullable(false);
            $table->integer('total_post_score')->nullable(false)->default(0);
            $table->integer('total_tag_score')->nullable(false)->default(0);
            $table->integer('total_score')->nullable(false)->default(0);
            $table->string('post_title', 255)->nullable(false);
            $table->boolean('is_read')->nullable(true)->comment('0: not read yet, 1: read = clicked on the post')->default(false);
            $table->tinyInteger('reaction')->nullable(true)->comment('1: like, -1: hate, 0: no reaction')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_posts');
    }
};
