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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hash_name');
            $table->text('path');
            $table->string('mime_type');
            $table->bigInteger('size');
            $table->binary('blob')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `media` MODIFY `blob` MEDIUMBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
