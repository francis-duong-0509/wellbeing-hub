<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\Currency;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 month', '+1 month');
        $endDate = clone $startDate;
        $endDate->modify('+'.fake()->numberBetween(1, 10).' days');
        
        $currencyId = Currency::inRandomOrder()->first()?->id ?? 1;
        $countryId = Country::inRandomOrder()->first()?->id;
        $stateId = State::inRandomOrder()->first()?->id;

        $teacherId = User::inRandomOrder()->first()?->id ?? User::factory();
        $createdById = User::inRandomOrder()->first()?->id ?? User::factory();

        return [
            'name' => fake()->sentence(4),
            'type' => fake()->randomElement(['offline', 'online']),
            'course_type_id' => CourseType::inRandomOrder()->first()?->id ?? CourseType::factory(),
            'fromdate' => $startDate,
            'todate' => $endDate,
            'price' => fake()->randomFloat(2, 10, 1000),
            'discount_type' => fake()->randomElement(['percentage', 'fixed', null]),
            'discount_price' => fake()->optional()->randomFloat(2, 5, 50),
            'discount_until' => fake()->optional()->dateTimeBetween('+1 week', '+1 month'),
            'capacity' => fake()->optional()->numberBetween(10, 100),
            'is_active' => fake()->boolean(90),
            'image' => fake()->imageUrl(),
            'thumbnail' => fake()->imageUrl(),
            'available_payment_methods' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'enable_member_discount' => fake()->boolean(),
            'description' => fake()->paragraph(),
            'available_for' => fake()->randomElement(['all', 'members_only']),
            'country_id' => $countryId,
            'state_id' => $stateId,
            'require_referral' => fake()->boolean(),
            'has_commission' => fake()->boolean(),
            'enable_registration' => fake()->boolean(),
            'created_by' => $createdById,
            'teacher_id' => $teacherId,
            'currency_id' => $currencyId,
            'language_code' => fake()->languageCode(),
            'limit_registration' => fake()->randomElement(['no_limit', 'only_retreat', 'only_fire_gathering']),
            'is_vip' => fake()->boolean(20),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
