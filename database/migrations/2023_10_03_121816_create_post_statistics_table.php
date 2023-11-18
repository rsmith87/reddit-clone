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
        Schema::create('post_statistics', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->primary();
            $table->bigInteger('view_count');
            $table->bigInteger('upvote_count');
            $table->bigInteger('downvote_count');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_statistics');
    }
};
