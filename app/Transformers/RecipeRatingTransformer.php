<?php

namespace App\Transformers;

use App\RecipeRating;
use League\Fractal\TransformerAbstract;

class RecipeRatingTransformer extends TransformerAbstract
{

    /**
     * @param RecipeRating $recipeRating
     * @return array
     */
    public function transform(RecipeRating $recipeRating)
    {
        return [
            'id'         => (int)$recipeRating->id,
            'recipes_id'  => (int)$recipeRating->recipes_id,
            'rating'     => (int)$recipeRating->rating,
            'comment'    => $recipeRating->comment,
            'created_at' => $recipeRating->created_at->toDateTimeString(),
            'updated_at' => $recipeRating->updated_at->toDateTimeString()
        ];
    }
}
