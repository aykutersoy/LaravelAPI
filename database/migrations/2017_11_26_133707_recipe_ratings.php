<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecipeRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recipes_id');
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();

            $table->foreign('recipes_id')->references('id')->on('recipes')->onDelete('cascade');
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
        Schema::dropIfExists('recipe_ratings');
    }
}
