<?php

namespace Database\Seeders;

use App\Models\CollectionPoint;
use Illuminate\Database\Seeder;

class CollectionPointSeeder extends Seeder
{
    public function run(): void
    {
        $points = [
            [
                'name' => 'Ponto Verde Centro',
                'address' => 'Rua das Acácias, 120',
                'neighborhood' => 'Centro',
                'city' => 'Cotia',
                'state' => 'SP',
                'opening_hours' => 'Segunda a sábado, das 8h às 17h',
                'phone' => '(11) 4700-1001',
                'active' => true,
            ],
            [
                'name' => 'Ponto Verde Granja Viana',
                'address' => 'Avenida das Flores, 850',
                'neighborhood' => 'Granja Viana',
                'city' => 'Cotia',
                'state' => 'SP',
                'opening_hours' => 'Segunda a sexta, das 9h às 18h',
                'phone' => '(11) 4700-1002',
                'active' => true,
            ],
            [
                'name' => 'Ponto Verde Caucaia',
                'address' => 'Estrada Municipal, 340',
                'neighborhood' => 'Caucaia do Alto',
                'city' => 'Cotia',
                'state' => 'SP',
                'opening_hours' => 'Terça a domingo, das 8h às 16h',
                'phone' => '(11) 4700-1003',
                'active' => true,
            ],
        ];

        foreach ($points as $point) {
            CollectionPoint::query()->updateOrCreate(
                ['name' => $point['name']],
                $point,
            );
        }
    }
}
