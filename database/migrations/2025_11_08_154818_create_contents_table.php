<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->default('movie'); // movie, series, documentary
            $table->string('genre')->nullable(); // action, drama, comedy, thriller, etc.
            $table->string('thumbnail')->nullable();
            $table->string('poster')->nullable();
            $table->string('banner')->nullable();
            $table->string('video')->nullable();
            $table->year('release_year')->nullable();
            $table->integer('duration')->nullable(); // in minutes
            $table->decimal('rating', 3, 1)->default(0); // 0.0 to 10.0
            $table->string('language')->default('English');
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_top_pick')->default(false);
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
};
