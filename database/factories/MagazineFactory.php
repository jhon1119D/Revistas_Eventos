<?php

namespace Database\Factories;

use App\Models\Magazine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MagazineFactory extends Factory
{
    protected $model = Magazine::class;

    public function definition()
    {
        return [
            'user_id' => 10, // Cambia este valor si quieres usar otro usuario
            'nombre' => $this->faker->sentence(3),
            'categoria' => substr($this->faker->word(), 0, 11),
            'enlace' => $this->faker->url,
            'accesibilidad' => $this->faker->randomElement(['si', 'no']),
            'pais' => substr($this->faker->country(), 0, 40),
            'clasificacion' => $this->faker->randomElement(['Q1', 'Q2', 'Q3']),
            'documento_url' => null,
            'autor_nombre' => $this->faker->name,
        ];
    }
}
