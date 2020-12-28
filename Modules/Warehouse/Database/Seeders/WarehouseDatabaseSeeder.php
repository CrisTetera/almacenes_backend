<?php

namespace Modules\Warehouse\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WarehouseDatabaseSeeder extends Seeder
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

        // WAREHOUSE
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhProductPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhItemPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhItemStockPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhPackPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhFamilyPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhPromoPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhProductsOnPromoPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhSubfamilyPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhTagPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhTagWhProductPosTableSeeder");
        $this->call("Modules\Warehouse\Database\Seeders\\$this->environmentPath\WhWarehousePosTableSeeder");

        // Enable FK
        DB::statement("SET session_replication_role = 'origin';");
        Model::reguard();
    }
}
