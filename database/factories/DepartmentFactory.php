<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;


class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $dept= Department::class;

    public function definition()
    {
        return [
            'name'=>$this->faker->name(),

        ];
    }
}
