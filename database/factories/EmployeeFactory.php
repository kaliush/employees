<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('uk_UA');

        return [
            'name' => $faker->firstName() . ' ' . $faker->lastName(),
            'position_id' => Position::factory(),
            'hire_date' => $faker->dateTimeBetween('-10 years', 'now'),
            'phone' => $faker->unique()->e164PhoneNumber,
            'email' => $faker->unique()->numberBetween(1, 50000) . $faker->unique()->safeEmail,
            'salary' => $faker->randomFloat(2, 0, 500000),
            'photo' => 'https://i.pravatar.cc/300?u=' . $faker->unique()->numberBetween(1, 50000)
        ];
    }
}
