<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ["consumable", "tooling"];
        $repair_states = ["pristine", "must_repair", "been_repaired"];

        return [
            "denomination" => $this->faker->word() ,
            "serial_number" => $this->faker->uuid() ,
            "archived" => random_int(0,1) ,
            "repair_state" =>$repair_states[random_int(0,2)] ,
            "type" =>$types[random_int(0,1)] ,
        ];
    }
}
