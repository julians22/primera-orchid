<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'SUBSCRIPTION REGULAR',
                'description' => 'To note: For subscription, we collect back the pot & old plant and replace with fresh ones, prices above are prices for every replacement (~4 weeks). Minimum subscription: 3 months',
                'items' => [
                    'X1 - IDR 200.000 (Min 2 pots)',
                    'X2 - IDR 400.000',
                    'X3 - IDR 600.000',
                    'X5 - IDR 1.000.000',
                    'X6 - IDR 1.200.000',
                    'X8 - IDR 1.800.000',
                ],
            ],
            [
                'title' => 'SUBSCRIPTION MINI',
                'description' => 'To note: For subscription, we collect back the pot & old plant and replace with fresh ones, prices above are prices for every replacement (~4 weeks). Minimum subscription: 3 months',
                'items' => [
                    'Double Mini - IDR 280.000 (Min 2 pots)',
                    'Triple Mini - IDR 420.000',
                    'Four Mini - IDR 560.000',
                    'Five Mini - IDR 700.000',
                    'Six Mini - IDR 840.000',
                    'Eight Mini - IDR 1.120.000',
                ],
            ],
        ];

        foreach ($services as $serviceData) {
            $service = Service::create([
                'title' => $serviceData['title'],
                'description' => $serviceData['description'],
            ]);

            foreach ($serviceData['items'] as $index => $title) {
                $service->items()->create([
                    'title' => $title,
                    'sort_order' => $index + 1,
                ]);
            }
        }
    }
}
