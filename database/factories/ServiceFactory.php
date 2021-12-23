<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hairSizes = ['Men', 'Women Short Hair', 'Women Medium Hair', 'Women Long Hair'];
        $hairTypes = ['Straight', 'Wavy', 'Curly', 'Coily'];

        $hairSizeIndex = rand(0, 3);
        $name = $this->faker->word();

        return [
            'name' => $name,
            'name_en' => $name . ' EN',
            'duration' => rand(20, 60),

            'stylist_price' => $this->faker->randomFloat(null, 10, 100),
            'art_director_price' => $this->faker->randomFloat(null, 10, 100),

            'hair_size' => $hairSizes[$hairSizeIndex],
            'hair_type' => ($hairSizeIndex !== 0) ? $hairTypes[rand(0, 3)] : NULL,
        ];
    }
}
