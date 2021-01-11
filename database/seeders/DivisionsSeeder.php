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
                'division_name' => 'Production',
                'descriptions' => 'The production department turns raw material or other inputs into final products following a series of processes.'
            ],
            [
                'division_name' => 'Research & Development',
                'descriptions' => 'R&D help direct the future of a business because it provides essential information and ideas that support strategic decision-making.'
            ],
            [
                'division_name' => 'Purchasing',
                'descriptions' => 'Purchasing department must handle the planning, monitoring, and execution of supply chain activities.'
            ],
            [
                'division_name' => 'ICT',
                'descriptions' => 'ICT is an extensional term for information technology (IT) that stresses the role of unified communications[1] and the integration of telecommunications (telephone lines and wireless signals) and computers.'
            ],

        ];

        foreach ($divisions as $division) {
            Division::create(array(
                'division_name' => $division['division_name'],
                'descriptions' => $division['descriptions'],
            ));
        }
    }
}
