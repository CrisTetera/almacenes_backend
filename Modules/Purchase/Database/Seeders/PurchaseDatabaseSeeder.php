<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable FK
        Model::unguard();
        DB::statement("SET session_replication_role = 'replica';");

        // COMPRA
        // $this->call(PchPaymentConditionTableSeeder::class);
        // $this->call(PchPurchaseOrderStateTableSeeder::class);
        // $this->call(PchPurchaseOrderTableSeeder::class);
        // $this->call(PchDetailPurchaseOrderTableSeeder::class);
        // $this->call(PchProviderDebtToPayTableSeeder::class);
        // $this->call(PchProviderDebtToPayPchDetailProviderPaymentSheetTableSeeder::class);
        // $this->call(PchPurchaseDebitNoteTableSeeder::class);
        // $this->call(PchPurchaseInvoiceTableSeeder::class);
        // $this->call(PchProviderTableSeeder::class);
        // $this->call(PchPurchaseOrderWhOrdererTableSeeder::class);
        // $this->call(PchPurchaseCreditNoteTableSeeder::class);
        // $this->call(PchTypeProviderAccountMovementTableSeeder::class);
        // $this->call(PchProviderAccountBankTableSeeder::class);
        // $this->call(PchProviderPaymentTableSeeder::class);
        // $this->call(PchProviderAccountTableSeeder::class);
        // $this->call(PchProviderPaymentSheetTableSeeder::class);
        // $this->call(PchPurchaseQuotationTableSeeder::class);
        // $this->call(PchProviderAccountMovementTableSeeder::class);
        // $this->call(PchDetailProviderPaymentSheetTableSeeder::class);
        // $this->call(PchDetailPurchaseDebitNoteTableSeeder::class);
        // $this->call(PchDetailPurchaseInvoiceTableSeeder::class);
        // $this->call(PchDetailPurchaseCreditNoteTableSeeder::class);
        // $this->call(PchDetailPurchaseQuotationTableSeeder::class);
        // $this->call(PchProviderBranchOfficesTableSeeder::class);

        // Enable FK
        DB::statement("SET session_replication_role = 'origin';");
        Model::reguard();
    }
}
