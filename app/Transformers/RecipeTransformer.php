<?php

namespace App\Transformers;

use App\Recipes;
use League\Fractal\TransformerAbstract;

class RecipeTransformer extends TransformerAbstract
{
    /**
     * List of resources to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'ratings'
    ];

    /**
     * @param Recipes $recipe
     * @return array
     */
    public function transform(Recipes $recipe)
    {
        return [
            'id'                       => (int)$recipe->id,
            'created_at'               => $recipe->created_at->toDateTimeString(),
            'updated_at'               => $recipe->updated_at->toDateTimeString(),
            'box_type'                 => $recipe->box_type,
            'title'                    => $recipe->title,
            'slug'                     => $recipe->slug,
            'short_title'              => $recipe->short_title,
            'marketing_description'    => $recipe->marketing_description,
            'calories_kcal'            => (int)$recipe->calories_kcal,
            'protein_grams'            => (int)$recipe->protein_grams,
            'fat_grams'                => (int)$recipe->fat_grams,
            'carbs_grams'              => (int)$recipe->carbs_grams,
            'bulletpoint1'             => $recipe->bulletpoint1,
            'bulletpoint2'             => $recipe->bulletpoint2,
            'bulletpoint3'             => $recipe->bulletpoint3,
            'recipe_diet_type_id'      => $recipe->recipe_diet_type_id,
            'season'                   => $recipe->season,
            'base'                     => $recipe->base,
            'protein_source'           => $recipe->protein_source,
            'preparation_time_minutes' => (int)$recipe->preparation_time_minutes,
            'shelf_life_days'          => (int)$recipe->shelf_life_days,
            'equipment_needed'         => $recipe->equipment_needed,
            'origin_country'           => $recipe->origin_country,
            'recipe_cuisine'           => $recipe->recipe_cuisine,
            'in_your_box'              => $recipe->in_your_box,
            'gousto_reference'         => (int)$recipe->gousto_reference
        ];
    }

    /**
     * @param Recipes $recipe
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeRatings(Recipes $recipe)
    {
        return is_null($recipe->ratings)
            ? null
            : $this->collection($recipe->ratings, new RecipeRatingTransformer());
    }
}
