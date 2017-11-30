<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * 
     * @todo box_type, protein_source, recipe_cuisine
     *      expected values written here hard coded which is not ideal
     *      this info should be stored in DB where you can increase or decrease the number of values
     */
    public function rules()
    {
        return [
            'box_type'                 => 'required|in:vegetarian,gourmet',
            'title'                    => 'required|string|max:255',
            'short_title'              => 'string|max:255',
            'marketing_description'    => 'required|string|max:2000',
            'calories_kcal'            => 'required|integer|min:0|max:32767',
            'protein_grams'            => 'required|integer|min:0|max:32767',
            'fat_grams'                => 'required|integer|min:0|max:32767',
            'carbs_grams'              => 'required|integer|min:0|max:32767',
            'bulletpoint1'             => 'string|max:255',
            'bulletpoint2'             => 'string|max:255',
            'bulletpoint3'             => 'string|max:255',
            'recipe_diet_type_id'      => 'required|string|max:255',
            'season'                   => 'required|string|max:255',
            'base'                     => 'string|max:255',
            'protein_source'           => 'required|in:beef,seafood,cheese,pork,chicken,eggs',
            'preparation_time_minutes' => 'required|integer|min:0|max:1000',
            'shelf_life_days'          => 'required|integer|min:1|max:365',
            'equipment_needed'         => 'required|string|max:2000',
            'origin_country'           => 'required|string|max:255',
            'recipe_cuisine'           => 'required|in:mexican,mediterranean,british,italian,asian',
            'in_your_box'              => 'string|max:2000',
            'gousto_reference'         => 'required|integer|min:0|max:2147483647',
        ];
    }
}
