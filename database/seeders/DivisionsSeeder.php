<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisions')->delete();

        $divisions = [
            [
                'division_name' => 'Gudang',
            ],
            [
                'division_name' => 'Food',
            ],
            [
                'division_name' => 'Non Food',
            ],
        ];

        foreach ($divisions as $division) {
            Division::create(array(
                'division_name' => $division['division_name'],
            ));
        }
    }
}
