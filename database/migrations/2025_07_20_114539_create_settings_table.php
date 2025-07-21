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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('fb')->nullable();
            $table->text('insta')->nullable();
            $table->text('call')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('snapchat')->nullable();
            $table->text('tiktok')->nullable();
            $table->text('youtube')->nullable();
                     $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
