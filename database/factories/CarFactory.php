<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = \App\Models\Car::class;

    private static array $catalog = [
        'Toyota'          => ['Camry', 'Corolla', 'RAV4', 'Highlander', 'Tacoma', 'Land Cruiser', 'Prius', '4Runner'],
        'Honda'           => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Odyssey', 'HR-V', 'Passport'],
        'Ford'            => ['F-150', 'Mustang', 'Explorer', 'Escape', 'Edge', 'Bronco', 'Ranger'],
        'BMW'             => ['3 Series', '5 Series', 'X3', 'X5', 'M3', 'M5', '7 Series'],
        'Mercedes-Benz'   => ['C-Class', 'E-Class', 'GLC', 'GLE', 'S-Class', 'A-Class', 'GLS'],
        'Chevrolet'       => ['Silverado', 'Malibu', 'Equinox', 'Tahoe', 'Corvette', 'Traverse', 'Blazer'],
        'Audi'            => ['A4', 'A6', 'Q5', 'Q7', 'TT', 'A3', 'Q3', 'e-tron'],
        'Hyundai'         => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Kona', 'Palisade'],
        'Nissan'          => ['Altima', 'Sentra', 'Rogue', 'Pathfinder', 'Frontier', 'Murano', 'Armada'],
        'Jeep'            => ['Wrangler', 'Cherokee', 'Grand Cherokee', 'Compass', 'Gladiator', 'Renegade'],
        'Volkswagen'      => ['Golf', 'Passat', 'Tiguan', 'Atlas', 'Jetta', 'ID.4'],
        'Subaru'          => ['Outback', 'Forester', 'Crosstrek', 'Impreza', 'Legacy', 'WRX'],
        'Kia'             => ['Sportage', 'Sorento', 'Telluride', 'Stinger', 'Soul', 'Carnival'],
        'Mazda'           => ['Mazda3', 'Mazda6', 'CX-5', 'CX-9', 'MX-5 Miata', 'CX-30'],
        'Lexus'           => ['ES', 'RX', 'NX', 'GX', 'IS', 'LS', 'LX'],
    ];

    private static array $typeMap = [
        'SUV'       => ['body-type' => ['Crossover', 'SUV', 'Off-Road'], 'makes' => ['Toyota', 'Honda', 'Ford', 'BMW', 'Jeep', 'Subaru', 'Kia', 'Mazda', 'Lexus']],
        'Sedan'     => ['body-type' => ['Compact', 'Mid-Size', 'Full-Size'], 'makes' => ['Toyota', 'Honda', 'BMW', 'Mercedes-Benz', 'Audi', 'Hyundai', 'Nissan', 'Mazda', 'Lexus', 'Kia']],
        'Truck'     => ['body-type' => ['Pickup', 'Light-Duty', 'Heavy-Duty'], 'makes' => ['Ford', 'Chevrolet', 'Nissan', 'Toyota', 'Jeep']],
        'Hatchback' => ['body-type' => ['Compact', 'Coupe', 'Hot Hatch'], 'makes' => ['Honda', 'Volkswagen', 'Subaru', 'Hyundai', 'Mazda', 'Kia']],
        'Coupe'     => ['body-type' => ['Coupe', 'Sport', 'Convertible'], 'makes' => ['BMW', 'Mercedes-Benz', 'Audi', 'Ford', 'Chevrolet', 'Lexus']],
        'Minivan'   => ['body-type' => ['Minivan', 'MPV'], 'makes' => ['Honda', 'Kia', 'Chrysler', 'Toyota']],
    ];

    public function definition(): array
    {
        $type     = $this->faker->randomElement(array_keys(self::$typeMap));
        $make     = $this->faker->randomElement(self::$typeMap[$type]['makes']);
        $models   = self::$catalog[$make] ?? ['Standard'];
        $bodyType = $this->faker->randomElement(self::$typeMap[$type]['body-type']);

        return [
            'type'      => $type,
            'make'      => $make,
            'model'     => $this->faker->randomElement($models),
            'year'      => (string) $this->faker->numberBetween(2005, 2024),
            'fuel-type' => $this->faker->randomElement(['Petrol', 'Diesel', 'Electric', 'Hybrid']),
            'body-type' => $bodyType,
            'variant-t' => $this->faker->randomElement(['Base', 'Sport', 'SE', 'XLE', 'Limited', 'Premium', 'Luxury', 'Platinum']),
            'imagePath' => 'images/default.jpg',
        ];
    }
}
