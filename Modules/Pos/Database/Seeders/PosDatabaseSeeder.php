<?php

namespace Modules\Pos\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Pos\Entities\PosTypePaymentMethodPos;

class PosDatabaseSeeder extends Seeder
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

        // POS
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosCashDeskPosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosSaleTypePosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosDetailPosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosSalePosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosSaleStockReservationPosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosTypePaymentMethodPosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosPaymentMethodPosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosMovementEgressTypePosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosMovementIngressTypePosTableSeeder");
        $this->call("Modules\Pos\Database\Seeders\\$this->environmentPath\PosDailyCashPosTableSeeder");

        // Enable FK
        DB::statement("SET session_replication_role = 'origin';");
        Model::reguard();
    }
}
