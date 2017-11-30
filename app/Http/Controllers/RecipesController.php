<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;
use App\RecipeRating;
use App\Recipes;
use App\Transformers\RecipeTransformer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;


class RecipesController extends Controller
{

    /**
     * @todo box_type, protein_source, recipe_cuisine
     *      expected values written here hard coded which is not ideal
     *      this info should be stored in DB where you can increase or decrease the number of values
     */
    protected $rules = [
            'box_type'                 => 'required|in:vegetarian,gourmet',
            'title'                    => 'required|string|max:255',
            'short_title'              => 'string|max:255|nullable',
            'marketing_description'    => 'required|string|max:2000',
            'calories_kcal'            => 'required|integer|min:0|max:32767',
            'protein_grams'            => 'required|integer|min:0|max:32767',
            'fat_grams'                => 'required|integer|min:0|max:32767',
            'carbs_grams'              => 'required|integer|min:0|max:32767',
            'bulletpoint1'             => 'string|max:255|nullable',
            'bulletpoint2'             => 'string|max:255|nullable',
            'bulletpoint3'             => 'string|max:255|nullable',
            'recipe_diet_type_id'      => 'required|string|max:255',
            'season'                   => 'required|string|max:255',
            'base'                     => 'string|max:255|nullable',
            'protein_source'           => 'required|in:beef,seafood,cheese,pork,chicken,eggs',
            'preparation_time_minutes' => 'required|integer|min:0|max:1000',
            'shelf_life_days'          => 'required|integer|min:1|max:365',
            'equipment_needed'         => 'required|string|max:2000',
            'origin_country'           => 'required|string|max:255',
            'recipe_cuisine'           => 'required|in:mexican,mediterranean,british,italian,asian',
            'in_your_box'              => 'string|max:2000|nullable',
            'gousto_reference'         => 'required|integer|min:0|max:2147483647',
        ];

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipes::find($id);

        if ($recipe instanceof Recipes) {
            return response()->json($this->getTransformedItem($recipe), 200);
        }

        return response('Requested data not found', 404);
    }
    
    /**
     * Display all resources based on cuisine input.
     * 
     * (Limited data displayed because of pagination)
     *
     * @param  string $cuisine
     * @return \Illuminate\Http\Response
     */
    public function showByCuisine($cuisine)
    {
        $paginateBy = config('constants.RECIPES_COLLETION_PAGINATE_VALUE');
        $paginator = Recipes::where('recipe_cuisine', $cuisine)->paginate($paginateBy);
        $paginatedRsp = $this->getTransformedColletions($paginator->getCollection())
                                   ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                                   ->toArray();

        
        if (isset($paginatedRsp["data"]) && count($paginatedRsp["data"]) > 0) {

            return response()->json($paginatedRsp, 200);
        }

        return response('Requested data not found', 404);
    }

    /**
     * Rate an existing recipe between 1 and 5.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipes_id' => 'required|exists:recipes,id',
            'rating'    => 'required|integer|between:1,5',
            'comment'   => 'string|max:2000|nullable'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $recipeRating = RecipeRating::create($request->all());
        
        $recipe = Recipes::find($recipeRating->recipes_id);

        return response()->json($this->getTransformedItem($recipe), 200);
    }

    /**
     * Update the specified recipe in storage.
     *
     * @param  RecipeRequest $request
     * @param  int           $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $recipe = Recipes::find($id);
 
        if ($recipe instanceof Recipes && $recipe->update($request->all())) {
            return response()->json($this->getTransformedItem($recipe), 200);
        }

        return response('Not Updated', 422);
    }

    /**
     * Store a new created recipe to storage.
     *
     * @param RecipeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }
        
        $newRecipe = Recipes::create($request->all());
        
        $recipe = Recipes::find($newRecipe->id);

        return response()->json($this->getTransformedItem($recipe), 200);
    }

    /**
     * @param Recipes $recipe
     * @return array
     */
    private function getTransformedItem(Recipes $recipe)
    {
        return fractal()
            ->item($recipe)
            ->transformWith(new RecipeTransformer())
            ->parseIncludes([
                'ratings'
            ])
            ->toArray();
    }

    /**
     * @param Collection $recipes
     * @return Fractal
     */
    private function getTransformedColletions(Collection $recipes)
    {
        return fractal()
            ->collection($recipes)
            ->transformWith(new RecipeTransformer())
            ->parseIncludes([
                'ratings'
            ]);
    }
}
