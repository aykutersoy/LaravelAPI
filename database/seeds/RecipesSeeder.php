<?php

use Illuminate\Database\Seeder;
use App\Recipes;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = Excel::load(database_path('data/recipe-data.csv'), function () {})->get();
        
        foreach ($recipes as $recipe) {
            $recipeArr = $recipe->toArray();
            
            Recipes::create([
                "id"                       => (int)$recipeArr['id'],
                "created_at"               => Carbon::createFromFormat('d/m/Y H:i:s',
                    $recipeArr['created_at']),
                "updated_at"               => Carbon::createFromFormat('d/m/Y H:i:s',
                    $recipeArr['updated_at']),
                "box_type"                 => $recipeArr['box_type'],
                "title"                    => $recipeArr['title'],
                "slug"                     => $recipeArr['slug'],
                "short_title"              => $recipeArr['short_title'],
                "marketing_description"    => $recipeArr['marketing_description'],
                "calories_kcal"            => (int)$recipeArr['calories_kcal'],
                "protein_grams"            => (int)$recipeArr['protein_grams'],
                "fat_grams"                => (int)$recipeArr['fat_grams'],
                "carbs_grams"              => (int)$recipeArr['carbs_grams'],
                "bulletpoint1"             => $recipeArr['bulletpoint1'],
                "bulletpoint2"             => $recipeArr['bulletpoint2'],
                "bulletpoint3"             => $recipeArr['bulletpoint3'],
                "recipe_diet_type_id"      => $recipeArr['recipe_diet_type_id'],
                "season"                   => $recipeArr['season'],
                "base"                     => $recipeArr['base'],
                "protein_source"           => $recipeArr['protein_source'],
                "preparation_time_minutes" => (int)$recipeArr['preparation_time_minutes'],
                "shelf_life_days"          => (int)$recipeArr['shelf_life_days'],
                "equipment_needed"         => $recipeArr['equipment_needed'],
                "origin_country"           => $recipeArr['origin_country'],
                "recipe_cuisine"           => $recipeArr['recipe_cuisine'],
                "in_your_box"              => $recipeArr['in_your_box'],
                "gousto_reference"         => (int)$recipeArr['gousto_reference'],
            ]);
        }

    }
}
