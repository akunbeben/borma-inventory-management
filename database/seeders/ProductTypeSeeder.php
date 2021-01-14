<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->delete();

        $productTypes = [
            ['type' => 'Food'],
            ['type' => 'Non-Food'],
        ];

        foreach ($productTypes as $productType) {
            ProductType::create(array(
                'type' => $productType['type'],
            ));
        }
    }
}
