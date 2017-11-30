# Laravel API Test
This is a test project for Gousto


## How to use

- Installing
    - Clone the repository
        - `git clone https://github.com/aykutersoy/LaravelAPI.git`
    - Install dependencies by running
        - `composer install`
- Configuration
    -  copy .env.example to create your own
        -  `cp .env.example .env`
    -  create `recipes.sqlite` file where `www-data` user has rights to read and write (this ideally would be stored in database/ folder)
    -  In copied .env file add absolute directory path to `DB_DATABASE` of the sqlite database `recipes.sqlite`
    - Before we migrate the database let's check if php's sqlite driver installed
        -  `php -m | grep sqlite`
        -  If not return any result run the following (Debian, Ubuntu)
            -  `sudo apt-get install php-sqlite3` (this will install the latest depends on the distribution version mine install "php7.0-sqlite3")
            -  `sudo service apache2 restart`
    - Migrate the database with two tables along with a seed which will be created by .csv file provided.
        - `php artisan migrate --seed`
- Now you are all setup and ready to start the server

- Actions handled by Router

| Method | URI | Action | RouteName |
| -------|-------|-------|------- |
| GET | api/recipes/{id} | show | App\Http\Controllers\RecipesController@show |
| GET | api/recipes/cuisine/{cuisine} | showByCuisine | App\Http\Controllers\RecipesController@showByCuisine |
| POST | api/recipe/rate | rate | App\Http\Controllers\RecipesController@rate |
| POST | api/recipes | store | App\Http\Controllers\RecipesController@store |
| PUT | api/recipes/{id} | update | App\Http\Controllers\RecipesController@update |


Please make sure you choose `Content-Type` value of `application\json` for POST and PUT calls

- Example of methods

- GET | `api/recipes/{id}` | show
- GET | `api/recipes/cuisine/{cuisine}` | showByCuisine
- POST | `api/recipe/rate` | rate

```
  {
      "recipes_id" : 1,
      "rating": 5,
      "comment" : "Loved it!"
  }
```

- POST | `api/recipes` | store

and
- PUT | `api/recipes/{id}` | update

Expected request for POST api/recipes and PUT api/recipes/{id} methods:
  ```
  {
    "box_type": "gourmet",
    "title": "Tamil Nadu Prawn Masala",
    "short_title": null,
    "marketing_description": "a marketing description",
    "calories_kcal": "545",
    "protein_grams": "98",
    "fat_grams": "100",
    "carbs_grams": "0",
    "bulletpoint1": null,
    "bulletpoint2": null,
    "bulletpoint3": null,
    "recipe_diet_type_id": "fish",
    "season": "all",
    "base": "noodles",
    "protein_source": "seafood",
    "preparation_time_minutes": "35",
    "shelf_life_days": "4",
    "equipment_needed": "Appetite",
    "origin_country": "Great Britain",
    "recipe_cuisine": "italian",
    "in_your_box": null,
    "gousto_reference": "58"
  }
  ```

Expected response for all methods above should be JSON objcet with recipe or recipes listed as a data attribute.
```
{
    "data": {
        "id": 2,
        "created_at": "2015-06-30 17:58:00",
        "updated_at": "2015-06-30 17:58:00",
        "box_type": "gourmet",
        "title": "Tamil Nadu Prawn Masala",
        "slug": "tamil-nadu-prawn-masala",
        "short_title": null,
        "marketing_description": "some martketing information",
        "calories_kcal": 524,
        "protein_grams": 12,
        "fat_grams": 22,
        "carbs_grams": 0,
        "bulletpoint1": "Vibrant & Fresh",
        "bulletpoint2": "Warming, not spicy",
        "bulletpoint3": "Curry From Scratch",
        "recipe_diet_type_id": "fish",
        "season": "all",
        "base": "pasta",
        "protein_source": "seafood",
        "preparation_time_minutes": 40,
        "shelf_life_days": 4,
        "equipment_needed": "Appetite",
        "origin_country": "Great Britain",
        "recipe_cuisine": "italian",
        "in_your_box": "king prawns",
        "gousto_reference": 58,
        "ratings": {
            "data": [
                {
                    "id": 1,
                    "recipes_id": 1,
                    "rating": 2,
                    "comment": "Comment",
                    "created_at": "2017-11-27 01:09:01",
                    "updated_at": "2017-11-27 01:09:01"
                }
            ]
        }
    }
}
```

## Reason of choice
I chose Laravel simple it is one of the best framework for PHP front/back end development. I allowed me to to develop clean, robust and easy to maintain code. 

## How this API cater for different consumers
This RESTful API will serve all relavent parties whether you are calling it from mobile app, website or using other tools, such as; Postman, cURL, etc.

## TODO

- Improve Authentication piece to make it secure.
- Spare some time to write Test scripts to make sure you covered all methods
- Fix the bug in PUT api/recipes/{id} where you update title but not slug.
- Other improvements will continue.
