<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id" => Uuid::uuid4()->getHex(),
            "clinic_name" => "Metro-Klinik",
            "registered_by" => "System",
            "licence_duration" => 365,
            "address" => "Alamat"
        ];
    }
}
