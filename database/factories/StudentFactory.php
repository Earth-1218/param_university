<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    // Define the model that the factory is for
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'enrollment_no' => $this->faker->unique()->numberBetween(100000, 999999),
            'course_id' => $this->faker->numberBetween(1, 10), // Assuming you have courses from 1 to 10
            'name' => $this->faker->name,
            'father_name' => $this->faker->name,
            'mother_name' => $this->faker->name,
            'aadhaar_no' => $this->faker->unique()->numberBetween(100000000000, 999999999999),
            'mobile_no' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'dob' => $this->faker->date('Y-m-d', '2005-12-31'), // Assuming students are born before 2005
            'about' => $this->faker->paragraph,
            'merital_status' => $this->faker->randomElement(['married', 'unmarried']),
            'joining_date' => $this->faker->date('Y-m-d', '2023-01-01'), // Assuming they joined in 2023
            'departure_date' => $this->faker->date('Y-m-d', '2024-12-31'), // Assuming they will leave by 2024
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, // Assuming no one is deleted yet
        ];
    }
}
