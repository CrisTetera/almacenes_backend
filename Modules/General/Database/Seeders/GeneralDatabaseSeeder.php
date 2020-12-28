<?php

namespace Modules\General\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use  DB;

class GeneralDatabaseSeeder extends Seeder
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
        // Local and Testing Environment use local Path for Seeds
        $this->environmentPath = env('APP_ENV') === 'production'  ||
                                env('APP_ENV') === 'qa' ||
                                env('APP_ENV') === 'integration' ?
                                'Production':
                                'local';

        //disable FK
        Model::unguard();
        DB::statement("SET session_replication_role = 'replica';");
        
        // AUDIT
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\AuditHistoricPriceTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\AuditSendedEmailLogsTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\AuditSystemLogsTableSeeder");

        // GLOBAL
        
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GRegionPosTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GProvincePosTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GCommunePosTableSeeder");
        
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GCompanyPosTableSeeder");
        // $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GBankTableSeeder);
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GStateTypePosTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GStatePosTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GSystemConfigurationTableSeeder");
        // $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GTypeAccountBankTableSeeder);
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GUserPosTableSeeder");

        // Roles and Permissions
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\RolePermissionTableSeeder");

        // Module, Menu, Submenu
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GModulePosTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GMenuPosTableSeeder");
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GSubmenuPosTableSeeder");


        // Core Business (Giros) Sii
        $this->call("Modules\General\Database\Seeders\\$this->environmentPath\GCoreBusinessSiiTableSeeder");

        // Enable FK
        DB::statement("SET session_replication_role = 'origin';");
        Model::reguard();
    }
}
