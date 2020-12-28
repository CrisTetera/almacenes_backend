<?php

namespace Modules\HR\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HRDatabaseSeeder extends Seeder
{
    /** @var string */
    private $environmentPath;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->environmentPath = env('APP_ENV') === 'production'  ||
                                env('APP_ENV') === 'qa' ||
                                env('APP_ENV') === 'integration' ?
                                'Production':
                                'local';
        //disable FK
        Model::unguard();
        DB::statement("SET session_replication_role = 'replica';");

        // $this->call(HrEmployeeTableSeeder::class);
        $this->call("Modules\HR\Database\Seeders\\$this->environmentPath\HrEmployeePosTableSeeder");
        // $this->call(HrEmployeePresetsDiscountTableSeeder::class);

        // Enable FK
        DB::statement("SET session_replication_role = 'origin';");
        Model::reguard();
    }
}
