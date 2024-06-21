<?php

namespace Database\Factories;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// $factory->define(Wishlist::class, function (Faker $fakse)) {
//     return [
//         'title' => $faker->word,
//         'content' => $faker->realText
//     ]
// }
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WishListsTableFactory extends Factory
{
    protected $model = Wishlist::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'content' => Str::random(10),
        ];
    }
}
