<?php

namespace Database\Seeders;

use App\Models\WasteCategory;
use Illuminate\Database\Seeder;

class WasteCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Restos de frutas e verduras',
            'Cascas e sementes',
            'Borra de café',
            'Folhas e resíduos de jardim',
            'Outros resíduos orgânicos',
        ];

        foreach ($categories as $name) {
            WasteCategory::query()->updateOrCreate(
                ['name' => $name],
                ['active' => true],
            );
        }
    }
}
