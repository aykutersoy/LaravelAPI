<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('box_type', 100);
            $table->string('title');
            $table->string('slug');
            $table->string('short_title')->nullable();
            $table->text('marketing_description');
            $table->unsignedSmallInteger('calories_kcal');
            $table->unsignedSmallInteger('protein_grams');
            $table->unsignedSmallInteger('fat_grams');
            $table->unsignedSmallInteger('carbs_grams');
            $table->string('bulletpoint1')->nullable();
            $table->string('bulletpoint2')->nullable();
            $table->string('bulletpoint3')->nullable();
            $table->string('recipe_diet_type_id',100);
            $table->string('season',100);
            $table->string('base')->nullable();
            $table->string('protein_source',100);
            $table->unsignedSmallInteger('preparation_time_minutes');
            $table->unsignedSmallInteger('shelf_life_days');
            $table->text('equipment_needed');
            $table->string('origin_country');
            $table->string('recipe_cuisine');
            $table->text('in_your_box')->nullable();
            $table->unsignedInteger('gousto_reference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
