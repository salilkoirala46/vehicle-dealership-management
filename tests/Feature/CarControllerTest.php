<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Car;

class CarControllerTest extends TestCase
{
    use RefreshDatabase; // Refresh the database for each test to avoid conflicts

    public function test_store_creates_a_car_successfully()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('car.jpg');

        $payload = [
            'type' => 'SUV',
            'make' => 'Toyota',
            'model' => 'Highlander',
            'year' => 2023,
            'fuelType' => 'Petrol',
            'bodyType' => 'Crossover',
            'variantT' => 'Premium',
            'image' => $image,
        ];

        $response = $this->postJson('/api/cars', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'type' => 'SUV',
                'make' => 'Toyota',
                'model' => 'Highlander',
                'year' => 2023,
            ]);

        Storage::disk('public')->assertExists('images/' . $image->hashName());

        $this->assertDatabaseHas('cars', [
            'type' => 'SUV',
            'make' => 'Toyota',
            'model' => 'Highlander',
            'year' => 2023,
            'fuel-type' => 'Petrol',
            'body-type' => 'Crossover',
            'variant-t' => 'Premium',
        ]);
    }

    public function test_store_fails_with_missing_fields()
    {
        // Send a POST request with incomplete payload
        $response = $this->postJson('/api/cars', [
            'type' => 'SUV',
            // Missing required fields like 'make', 'model', etc.
        ]);

        // Assert validation errors
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['make', 'model', 'year', 'fuelType', 'bodyType', 'variantT', 'image']);
    }
}

?>