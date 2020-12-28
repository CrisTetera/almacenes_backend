<?php

namespace Modules\HR\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class HrEmployeePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('hr_employee_pos')->delete();

        \DB::table('hr_employee_pos')->insert(array (
            // Los tres primeros están autorizados para hacer apertura, egreso e ingreso.
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('hr_employee')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
