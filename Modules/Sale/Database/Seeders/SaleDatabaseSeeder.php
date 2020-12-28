<?php

namespace Modules\Sale\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaleDatabaseSeeder extends Seeder
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
        Model::unguard();

        DB::statement("SET session_replication_role = 'replica';");

        // VENTA
        
        $this->call("Modules\Sale\Database\Seeders\\$this->environmentPath\SlCustomerPosTableSeeder");
        $this->call("Modules\Sale\Database\Seeders\\$this->environmentPath\SlOfferPosTableSeeder");
        $this->call("Modules\Sale\Database\Seeders\\$this->environmentPath\SlPriceListPosTableSeeder");

        // Enable FK
        DB::statement("SET session_replication_role = 'origin';");
        Model::reguard();
    }
}
