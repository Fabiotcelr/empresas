<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition(): array
    {
        return [
            'nit' => $this->faker->unique()->numerify('#########'), // NIT único de 9 dígitos
            'nombre' => $this->faker->company(),
            'direccion' => $this->faker->address(),
            'telefono' => $this->faker->phoneNumber(),
            'estado' => 'Activo',
        ];
    }

    public function inactive()
    {
        return $this->state(fn (array $attributes) => ['estado' => 'Inactivo']);
    }
}