<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchProviderAccountMovementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_provider_account_movement')->delete();
        
        \DB::table('pch_provider_account_movement')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 1,
                'pch_provider_payment_id' => 1,
                'pch_purchase_credit_note_id' => 1,
                'pch_purchase_debit_note_id' => 1,
                'pch_purchase_invoice_id' => 1,
                'flag_delete' => true,
            ),
            1 => 
            array (
                'id' => 2,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 2,
                'pch_provider_payment_id' => 2,
                'pch_purchase_credit_note_id' => 2,
                'pch_purchase_debit_note_id' => 2,
                'pch_purchase_invoice_id' => 2,
                'flag_delete' => true,
            ),
            2 => 
            array (
                'id' => 3,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 3,
                'pch_provider_payment_id' => 3,
                'pch_purchase_credit_note_id' => 3,
                'pch_purchase_debit_note_id' => 3,
                'pch_purchase_invoice_id' => 3,
                'flag_delete' => true,
            ),
            3 => 
            array (
                'id' => 4,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 4,
                'pch_provider_payment_id' => 4,
                'pch_purchase_credit_note_id' => 4,
                'pch_purchase_debit_note_id' => 4,
                'pch_purchase_invoice_id' => 4,
                'flag_delete' => true,
            ),
            4 => 
            array (
                'id' => 5,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 5,
                'pch_provider_payment_id' => 5,
                'pch_purchase_credit_note_id' => 5,
                'pch_purchase_debit_note_id' => 5,
                'pch_purchase_invoice_id' => 5,
                'flag_delete' => false,
            ),
            5 => 
            array (
                'id' => 6,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 6,
                'pch_provider_payment_id' => 6,
                'pch_purchase_credit_note_id' => 6,
                'pch_purchase_debit_note_id' => 6,
                'pch_purchase_invoice_id' => 6,
                'flag_delete' => true,
            ),
            6 => 
            array (
                'id' => 7,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 7,
                'pch_provider_payment_id' => 7,
                'pch_purchase_credit_note_id' => 7,
                'pch_purchase_debit_note_id' => 7,
                'pch_purchase_invoice_id' => 7,
                'flag_delete' => true,
            ),
            7 => 
            array (
                'id' => 8,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 8,
                'pch_provider_payment_id' => 8,
                'pch_purchase_credit_note_id' => 8,
                'pch_purchase_debit_note_id' => 8,
                'pch_purchase_invoice_id' => 8,
                'flag_delete' => false,
            ),
            8 => 
            array (
                'id' => 9,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 9,
                'pch_provider_payment_id' => 9,
                'pch_purchase_credit_note_id' => 9,
                'pch_purchase_debit_note_id' => 9,
                'pch_purchase_invoice_id' => 9,
                'flag_delete' => false,
            ),
            9 => 
            array (
                'id' => 10,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 10,
                'pch_provider_payment_id' => 10,
                'pch_purchase_credit_note_id' => 10,
                'pch_purchase_debit_note_id' => 10,
                'pch_purchase_invoice_id' => 10,
                'flag_delete' => false,
            ),
            10 => 
            array (
                'id' => 11,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 11,
                'pch_provider_payment_id' => 11,
                'pch_purchase_credit_note_id' => 11,
                'pch_purchase_debit_note_id' => 11,
                'pch_purchase_invoice_id' => 11,
                'flag_delete' => true,
            ),
            11 => 
            array (
                'id' => 12,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 12,
                'pch_provider_payment_id' => 12,
                'pch_purchase_credit_note_id' => 12,
                'pch_purchase_debit_note_id' => 12,
                'pch_purchase_invoice_id' => 12,
                'flag_delete' => false,
            ),
            12 => 
            array (
                'id' => 13,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 13,
                'pch_provider_payment_id' => 13,
                'pch_purchase_credit_note_id' => 13,
                'pch_purchase_debit_note_id' => 13,
                'pch_purchase_invoice_id' => 13,
                'flag_delete' => false,
            ),
            13 => 
            array (
                'id' => 14,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 14,
                'pch_provider_payment_id' => 14,
                'pch_purchase_credit_note_id' => 14,
                'pch_purchase_debit_note_id' => 14,
                'pch_purchase_invoice_id' => 14,
                'flag_delete' => true,
            ),
            14 => 
            array (
                'id' => 15,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 15,
                'pch_provider_payment_id' => 15,
                'pch_purchase_credit_note_id' => 15,
                'pch_purchase_debit_note_id' => 15,
                'pch_purchase_invoice_id' => 15,
                'flag_delete' => false,
            ),
            15 => 
            array (
                'id' => 16,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 16,
                'pch_provider_payment_id' => 16,
                'pch_purchase_credit_note_id' => 16,
                'pch_purchase_debit_note_id' => 16,
                'pch_purchase_invoice_id' => 16,
                'flag_delete' => false,
            ),
            16 => 
            array (
                'id' => 17,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 17,
                'pch_provider_payment_id' => 17,
                'pch_purchase_credit_note_id' => 17,
                'pch_purchase_debit_note_id' => 17,
                'pch_purchase_invoice_id' => 17,
                'flag_delete' => true,
            ),
            17 => 
            array (
                'id' => 18,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 18,
                'pch_provider_payment_id' => 18,
                'pch_purchase_credit_note_id' => 18,
                'pch_purchase_debit_note_id' => 18,
                'pch_purchase_invoice_id' => 18,
                'flag_delete' => true,
            ),
            18 => 
            array (
                'id' => 19,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 19,
                'pch_provider_payment_id' => 19,
                'pch_purchase_credit_note_id' => 19,
                'pch_purchase_debit_note_id' => 19,
                'pch_purchase_invoice_id' => 19,
                'flag_delete' => false,
            ),
            19 => 
            array (
                'id' => 20,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 20,
                'pch_provider_payment_id' => 20,
                'pch_purchase_credit_note_id' => 20,
                'pch_purchase_debit_note_id' => 20,
                'pch_purchase_invoice_id' => 20,
                'flag_delete' => true,
            ),
            20 => 
            array (
                'id' => 21,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 21,
                'pch_provider_payment_id' => 21,
                'pch_purchase_credit_note_id' => 21,
                'pch_purchase_debit_note_id' => 21,
                'pch_purchase_invoice_id' => 21,
                'flag_delete' => false,
            ),
            21 => 
            array (
                'id' => 22,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 22,
                'pch_provider_payment_id' => 22,
                'pch_purchase_credit_note_id' => 22,
                'pch_purchase_debit_note_id' => 22,
                'pch_purchase_invoice_id' => 22,
                'flag_delete' => false,
            ),
            22 => 
            array (
                'id' => 23,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 23,
                'pch_provider_payment_id' => 23,
                'pch_purchase_credit_note_id' => 23,
                'pch_purchase_debit_note_id' => 23,
                'pch_purchase_invoice_id' => 23,
                'flag_delete' => true,
            ),
            23 => 
            array (
                'id' => 24,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 24,
                'pch_provider_payment_id' => 24,
                'pch_purchase_credit_note_id' => 24,
                'pch_purchase_debit_note_id' => 24,
                'pch_purchase_invoice_id' => 24,
                'flag_delete' => true,
            ),
            24 => 
            array (
                'id' => 25,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 25,
                'pch_provider_payment_id' => 25,
                'pch_purchase_credit_note_id' => 25,
                'pch_purchase_debit_note_id' => 25,
                'pch_purchase_invoice_id' => 25,
                'flag_delete' => true,
            ),
            25 => 
            array (
                'id' => 26,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 26,
                'pch_provider_payment_id' => 26,
                'pch_purchase_credit_note_id' => 26,
                'pch_purchase_debit_note_id' => 26,
                'pch_purchase_invoice_id' => 26,
                'flag_delete' => true,
            ),
            26 => 
            array (
                'id' => 27,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 27,
                'pch_provider_payment_id' => 27,
                'pch_purchase_credit_note_id' => 27,
                'pch_purchase_debit_note_id' => 27,
                'pch_purchase_invoice_id' => 27,
                'flag_delete' => false,
            ),
            27 => 
            array (
                'id' => 28,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 28,
                'pch_provider_payment_id' => 28,
                'pch_purchase_credit_note_id' => 28,
                'pch_purchase_debit_note_id' => 28,
                'pch_purchase_invoice_id' => 28,
                'flag_delete' => true,
            ),
            28 => 
            array (
                'id' => 29,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 29,
                'pch_provider_payment_id' => 29,
                'pch_purchase_credit_note_id' => 29,
                'pch_purchase_debit_note_id' => 29,
                'pch_purchase_invoice_id' => 29,
                'flag_delete' => false,
            ),
            29 => 
            array (
                'id' => 30,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 30,
                'pch_provider_payment_id' => 30,
                'pch_purchase_credit_note_id' => 30,
                'pch_purchase_debit_note_id' => 30,
                'pch_purchase_invoice_id' => 30,
                'flag_delete' => true,
            ),
            30 => 
            array (
                'id' => 31,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 31,
                'pch_provider_payment_id' => 31,
                'pch_purchase_credit_note_id' => 31,
                'pch_purchase_debit_note_id' => 31,
                'pch_purchase_invoice_id' => 31,
                'flag_delete' => false,
            ),
            31 => 
            array (
                'id' => 32,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 32,
                'pch_provider_payment_id' => 32,
                'pch_purchase_credit_note_id' => 32,
                'pch_purchase_debit_note_id' => 32,
                'pch_purchase_invoice_id' => 32,
                'flag_delete' => false,
            ),
            32 => 
            array (
                'id' => 33,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 33,
                'pch_provider_payment_id' => 33,
                'pch_purchase_credit_note_id' => 33,
                'pch_purchase_debit_note_id' => 33,
                'pch_purchase_invoice_id' => 33,
                'flag_delete' => false,
            ),
            33 => 
            array (
                'id' => 34,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 34,
                'pch_provider_payment_id' => 34,
                'pch_purchase_credit_note_id' => 34,
                'pch_purchase_debit_note_id' => 34,
                'pch_purchase_invoice_id' => 34,
                'flag_delete' => false,
            ),
            34 => 
            array (
                'id' => 35,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 35,
                'pch_provider_payment_id' => 35,
                'pch_purchase_credit_note_id' => 35,
                'pch_purchase_debit_note_id' => 35,
                'pch_purchase_invoice_id' => 35,
                'flag_delete' => true,
            ),
            35 => 
            array (
                'id' => 36,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 36,
                'pch_provider_payment_id' => 36,
                'pch_purchase_credit_note_id' => 36,
                'pch_purchase_debit_note_id' => 36,
                'pch_purchase_invoice_id' => 36,
                'flag_delete' => true,
            ),
            36 => 
            array (
                'id' => 37,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 37,
                'pch_provider_payment_id' => 37,
                'pch_purchase_credit_note_id' => 37,
                'pch_purchase_debit_note_id' => 37,
                'pch_purchase_invoice_id' => 37,
                'flag_delete' => false,
            ),
            37 => 
            array (
                'id' => 38,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 38,
                'pch_provider_payment_id' => 38,
                'pch_purchase_credit_note_id' => 38,
                'pch_purchase_debit_note_id' => 38,
                'pch_purchase_invoice_id' => 38,
                'flag_delete' => false,
            ),
            38 => 
            array (
                'id' => 39,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 39,
                'pch_provider_payment_id' => 39,
                'pch_purchase_credit_note_id' => 39,
                'pch_purchase_debit_note_id' => 39,
                'pch_purchase_invoice_id' => 39,
                'flag_delete' => false,
            ),
            39 => 
            array (
                'id' => 40,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 40,
                'pch_provider_payment_id' => 40,
                'pch_purchase_credit_note_id' => 40,
                'pch_purchase_debit_note_id' => 40,
                'pch_purchase_invoice_id' => 40,
                'flag_delete' => true,
            ),
            40 => 
            array (
                'id' => 41,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 41,
                'pch_provider_payment_id' => 41,
                'pch_purchase_credit_note_id' => 41,
                'pch_purchase_debit_note_id' => 41,
                'pch_purchase_invoice_id' => 41,
                'flag_delete' => true,
            ),
            41 => 
            array (
                'id' => 42,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 42,
                'pch_provider_payment_id' => 42,
                'pch_purchase_credit_note_id' => 42,
                'pch_purchase_debit_note_id' => 42,
                'pch_purchase_invoice_id' => 42,
                'flag_delete' => false,
            ),
            42 => 
            array (
                'id' => 43,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 43,
                'pch_provider_payment_id' => 43,
                'pch_purchase_credit_note_id' => 43,
                'pch_purchase_debit_note_id' => 43,
                'pch_purchase_invoice_id' => 43,
                'flag_delete' => false,
            ),
            43 => 
            array (
                'id' => 44,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 44,
                'pch_provider_payment_id' => 44,
                'pch_purchase_credit_note_id' => 44,
                'pch_purchase_debit_note_id' => 44,
                'pch_purchase_invoice_id' => 44,
                'flag_delete' => false,
            ),
            44 => 
            array (
                'id' => 45,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 45,
                'pch_provider_payment_id' => 45,
                'pch_purchase_credit_note_id' => 45,
                'pch_purchase_debit_note_id' => 45,
                'pch_purchase_invoice_id' => 45,
                'flag_delete' => false,
            ),
            45 => 
            array (
                'id' => 46,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 46,
                'pch_provider_payment_id' => 46,
                'pch_purchase_credit_note_id' => 46,
                'pch_purchase_debit_note_id' => 46,
                'pch_purchase_invoice_id' => 46,
                'flag_delete' => false,
            ),
            46 => 
            array (
                'id' => 47,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 47,
                'pch_provider_payment_id' => 47,
                'pch_purchase_credit_note_id' => 47,
                'pch_purchase_debit_note_id' => 47,
                'pch_purchase_invoice_id' => 47,
                'flag_delete' => true,
            ),
            47 => 
            array (
                'id' => 48,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 48,
                'pch_provider_payment_id' => 48,
                'pch_purchase_credit_note_id' => 48,
                'pch_purchase_debit_note_id' => 48,
                'pch_purchase_invoice_id' => 48,
                'flag_delete' => false,
            ),
            48 => 
            array (
                'id' => 49,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 49,
                'pch_provider_payment_id' => 49,
                'pch_purchase_credit_note_id' => 49,
                'pch_purchase_debit_note_id' => 49,
                'pch_purchase_invoice_id' => 49,
                'flag_delete' => false,
            ),
            49 => 
            array (
                'id' => 50,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 50,
                'pch_provider_payment_id' => 50,
                'pch_purchase_credit_note_id' => 50,
                'pch_purchase_debit_note_id' => 50,
                'pch_purchase_invoice_id' => 50,
                'flag_delete' => false,
            ),
            50 => 
            array (
                'id' => 51,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 51,
                'pch_provider_payment_id' => 51,
                'pch_purchase_credit_note_id' => 51,
                'pch_purchase_debit_note_id' => 51,
                'pch_purchase_invoice_id' => 51,
                'flag_delete' => true,
            ),
            51 => 
            array (
                'id' => 52,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 52,
                'pch_provider_payment_id' => 52,
                'pch_purchase_credit_note_id' => 52,
                'pch_purchase_debit_note_id' => 52,
                'pch_purchase_invoice_id' => 52,
                'flag_delete' => false,
            ),
            52 => 
            array (
                'id' => 53,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 53,
                'pch_provider_payment_id' => 53,
                'pch_purchase_credit_note_id' => 53,
                'pch_purchase_debit_note_id' => 53,
                'pch_purchase_invoice_id' => 53,
                'flag_delete' => false,
            ),
            53 => 
            array (
                'id' => 54,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 54,
                'pch_provider_payment_id' => 54,
                'pch_purchase_credit_note_id' => 54,
                'pch_purchase_debit_note_id' => 54,
                'pch_purchase_invoice_id' => 54,
                'flag_delete' => false,
            ),
            54 => 
            array (
                'id' => 55,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 55,
                'pch_provider_payment_id' => 55,
                'pch_purchase_credit_note_id' => 55,
                'pch_purchase_debit_note_id' => 55,
                'pch_purchase_invoice_id' => 55,
                'flag_delete' => true,
            ),
            55 => 
            array (
                'id' => 56,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 56,
                'pch_provider_payment_id' => 56,
                'pch_purchase_credit_note_id' => 56,
                'pch_purchase_debit_note_id' => 56,
                'pch_purchase_invoice_id' => 56,
                'flag_delete' => false,
            ),
            56 => 
            array (
                'id' => 57,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 57,
                'pch_provider_payment_id' => 57,
                'pch_purchase_credit_note_id' => 57,
                'pch_purchase_debit_note_id' => 57,
                'pch_purchase_invoice_id' => 57,
                'flag_delete' => false,
            ),
            57 => 
            array (
                'id' => 58,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 58,
                'pch_provider_payment_id' => 58,
                'pch_purchase_credit_note_id' => 58,
                'pch_purchase_debit_note_id' => 58,
                'pch_purchase_invoice_id' => 58,
                'flag_delete' => false,
            ),
            58 => 
            array (
                'id' => 59,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 59,
                'pch_provider_payment_id' => 59,
                'pch_purchase_credit_note_id' => 59,
                'pch_purchase_debit_note_id' => 59,
                'pch_purchase_invoice_id' => 59,
                'flag_delete' => false,
            ),
            59 => 
            array (
                'id' => 60,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 60,
                'pch_provider_payment_id' => 60,
                'pch_purchase_credit_note_id' => 60,
                'pch_purchase_debit_note_id' => 60,
                'pch_purchase_invoice_id' => 60,
                'flag_delete' => false,
            ),
            60 => 
            array (
                'id' => 61,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 61,
                'pch_provider_payment_id' => 61,
                'pch_purchase_credit_note_id' => 61,
                'pch_purchase_debit_note_id' => 61,
                'pch_purchase_invoice_id' => 61,
                'flag_delete' => true,
            ),
            61 => 
            array (
                'id' => 62,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 62,
                'pch_provider_payment_id' => 62,
                'pch_purchase_credit_note_id' => 62,
                'pch_purchase_debit_note_id' => 62,
                'pch_purchase_invoice_id' => 62,
                'flag_delete' => false,
            ),
            62 => 
            array (
                'id' => 63,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 63,
                'pch_provider_payment_id' => 63,
                'pch_purchase_credit_note_id' => 63,
                'pch_purchase_debit_note_id' => 63,
                'pch_purchase_invoice_id' => 63,
                'flag_delete' => true,
            ),
            63 => 
            array (
                'id' => 64,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 64,
                'pch_provider_payment_id' => 64,
                'pch_purchase_credit_note_id' => 64,
                'pch_purchase_debit_note_id' => 64,
                'pch_purchase_invoice_id' => 64,
                'flag_delete' => false,
            ),
            64 => 
            array (
                'id' => 65,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 65,
                'pch_provider_payment_id' => 65,
                'pch_purchase_credit_note_id' => 65,
                'pch_purchase_debit_note_id' => 65,
                'pch_purchase_invoice_id' => 65,
                'flag_delete' => true,
            ),
            65 => 
            array (
                'id' => 66,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 66,
                'pch_provider_payment_id' => 66,
                'pch_purchase_credit_note_id' => 66,
                'pch_purchase_debit_note_id' => 66,
                'pch_purchase_invoice_id' => 66,
                'flag_delete' => false,
            ),
            66 => 
            array (
                'id' => 67,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 67,
                'pch_provider_payment_id' => 67,
                'pch_purchase_credit_note_id' => 67,
                'pch_purchase_debit_note_id' => 67,
                'pch_purchase_invoice_id' => 67,
                'flag_delete' => false,
            ),
            67 => 
            array (
                'id' => 68,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 68,
                'pch_provider_payment_id' => 68,
                'pch_purchase_credit_note_id' => 68,
                'pch_purchase_debit_note_id' => 68,
                'pch_purchase_invoice_id' => 68,
                'flag_delete' => false,
            ),
            68 => 
            array (
                'id' => 69,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 69,
                'pch_provider_payment_id' => 69,
                'pch_purchase_credit_note_id' => 69,
                'pch_purchase_debit_note_id' => 69,
                'pch_purchase_invoice_id' => 69,
                'flag_delete' => true,
            ),
            69 => 
            array (
                'id' => 70,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 70,
                'pch_provider_payment_id' => 70,
                'pch_purchase_credit_note_id' => 70,
                'pch_purchase_debit_note_id' => 70,
                'pch_purchase_invoice_id' => 70,
                'flag_delete' => false,
            ),
            70 => 
            array (
                'id' => 71,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 71,
                'pch_provider_payment_id' => 71,
                'pch_purchase_credit_note_id' => 71,
                'pch_purchase_debit_note_id' => 71,
                'pch_purchase_invoice_id' => 71,
                'flag_delete' => false,
            ),
            71 => 
            array (
                'id' => 72,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 72,
                'pch_provider_payment_id' => 72,
                'pch_purchase_credit_note_id' => 72,
                'pch_purchase_debit_note_id' => 72,
                'pch_purchase_invoice_id' => 72,
                'flag_delete' => false,
            ),
            72 => 
            array (
                'id' => 73,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 73,
                'pch_provider_payment_id' => 73,
                'pch_purchase_credit_note_id' => 73,
                'pch_purchase_debit_note_id' => 73,
                'pch_purchase_invoice_id' => 73,
                'flag_delete' => true,
            ),
            73 => 
            array (
                'id' => 74,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 74,
                'pch_provider_payment_id' => 74,
                'pch_purchase_credit_note_id' => 74,
                'pch_purchase_debit_note_id' => 74,
                'pch_purchase_invoice_id' => 74,
                'flag_delete' => true,
            ),
            74 => 
            array (
                'id' => 75,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 75,
                'pch_provider_payment_id' => 75,
                'pch_purchase_credit_note_id' => 75,
                'pch_purchase_debit_note_id' => 75,
                'pch_purchase_invoice_id' => 75,
                'flag_delete' => true,
            ),
            75 => 
            array (
                'id' => 76,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 76,
                'pch_provider_payment_id' => 76,
                'pch_purchase_credit_note_id' => 76,
                'pch_purchase_debit_note_id' => 76,
                'pch_purchase_invoice_id' => 76,
                'flag_delete' => false,
            ),
            76 => 
            array (
                'id' => 77,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 77,
                'pch_provider_payment_id' => 77,
                'pch_purchase_credit_note_id' => 77,
                'pch_purchase_debit_note_id' => 77,
                'pch_purchase_invoice_id' => 77,
                'flag_delete' => false,
            ),
            77 => 
            array (
                'id' => 78,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 78,
                'pch_provider_payment_id' => 78,
                'pch_purchase_credit_note_id' => 78,
                'pch_purchase_debit_note_id' => 78,
                'pch_purchase_invoice_id' => 78,
                'flag_delete' => true,
            ),
            78 => 
            array (
                'id' => 79,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 79,
                'pch_provider_payment_id' => 79,
                'pch_purchase_credit_note_id' => 79,
                'pch_purchase_debit_note_id' => 79,
                'pch_purchase_invoice_id' => 79,
                'flag_delete' => true,
            ),
            79 => 
            array (
                'id' => 80,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 80,
                'pch_provider_payment_id' => 80,
                'pch_purchase_credit_note_id' => 80,
                'pch_purchase_debit_note_id' => 80,
                'pch_purchase_invoice_id' => 80,
                'flag_delete' => false,
            ),
            80 => 
            array (
                'id' => 81,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 81,
                'pch_provider_payment_id' => 81,
                'pch_purchase_credit_note_id' => 81,
                'pch_purchase_debit_note_id' => 81,
                'pch_purchase_invoice_id' => 81,
                'flag_delete' => false,
            ),
            81 => 
            array (
                'id' => 82,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 82,
                'pch_provider_payment_id' => 82,
                'pch_purchase_credit_note_id' => 82,
                'pch_purchase_debit_note_id' => 82,
                'pch_purchase_invoice_id' => 82,
                'flag_delete' => true,
            ),
            82 => 
            array (
                'id' => 83,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 83,
                'pch_provider_payment_id' => 83,
                'pch_purchase_credit_note_id' => 83,
                'pch_purchase_debit_note_id' => 83,
                'pch_purchase_invoice_id' => 83,
                'flag_delete' => false,
            ),
            83 => 
            array (
                'id' => 84,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 84,
                'pch_provider_payment_id' => 84,
                'pch_purchase_credit_note_id' => 84,
                'pch_purchase_debit_note_id' => 84,
                'pch_purchase_invoice_id' => 84,
                'flag_delete' => true,
            ),
            84 => 
            array (
                'id' => 85,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 85,
                'pch_provider_payment_id' => 85,
                'pch_purchase_credit_note_id' => 85,
                'pch_purchase_debit_note_id' => 85,
                'pch_purchase_invoice_id' => 85,
                'flag_delete' => false,
            ),
            85 => 
            array (
                'id' => 86,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 86,
                'pch_provider_payment_id' => 86,
                'pch_purchase_credit_note_id' => 86,
                'pch_purchase_debit_note_id' => 86,
                'pch_purchase_invoice_id' => 86,
                'flag_delete' => true,
            ),
            86 => 
            array (
                'id' => 87,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 87,
                'pch_provider_payment_id' => 87,
                'pch_purchase_credit_note_id' => 87,
                'pch_purchase_debit_note_id' => 87,
                'pch_purchase_invoice_id' => 87,
                'flag_delete' => false,
            ),
            87 => 
            array (
                'id' => 88,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 88,
                'pch_provider_payment_id' => 88,
                'pch_purchase_credit_note_id' => 88,
                'pch_purchase_debit_note_id' => 88,
                'pch_purchase_invoice_id' => 88,
                'flag_delete' => false,
            ),
            88 => 
            array (
                'id' => 89,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 89,
                'pch_provider_payment_id' => 89,
                'pch_purchase_credit_note_id' => 89,
                'pch_purchase_debit_note_id' => 89,
                'pch_purchase_invoice_id' => 89,
                'flag_delete' => false,
            ),
            89 => 
            array (
                'id' => 90,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 90,
                'pch_provider_payment_id' => 90,
                'pch_purchase_credit_note_id' => 90,
                'pch_purchase_debit_note_id' => 90,
                'pch_purchase_invoice_id' => 90,
                'flag_delete' => true,
            ),
            90 => 
            array (
                'id' => 91,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 91,
                'pch_provider_payment_id' => 91,
                'pch_purchase_credit_note_id' => 91,
                'pch_purchase_debit_note_id' => 91,
                'pch_purchase_invoice_id' => 91,
                'flag_delete' => true,
            ),
            91 => 
            array (
                'id' => 92,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 92,
                'pch_provider_payment_id' => 92,
                'pch_purchase_credit_note_id' => 92,
                'pch_purchase_debit_note_id' => 92,
                'pch_purchase_invoice_id' => 92,
                'flag_delete' => true,
            ),
            92 => 
            array (
                'id' => 93,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 93,
                'pch_provider_payment_id' => 93,
                'pch_purchase_credit_note_id' => 93,
                'pch_purchase_debit_note_id' => 93,
                'pch_purchase_invoice_id' => 93,
                'flag_delete' => false,
            ),
            93 => 
            array (
                'id' => 94,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 94,
                'pch_provider_payment_id' => 94,
                'pch_purchase_credit_note_id' => 94,
                'pch_purchase_debit_note_id' => 94,
                'pch_purchase_invoice_id' => 94,
                'flag_delete' => false,
            ),
            94 => 
            array (
                'id' => 95,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 95,
                'pch_provider_payment_id' => 95,
                'pch_purchase_credit_note_id' => 95,
                'pch_purchase_debit_note_id' => 95,
                'pch_purchase_invoice_id' => 95,
                'flag_delete' => true,
            ),
            95 => 
            array (
                'id' => 96,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 96,
                'pch_provider_payment_id' => 96,
                'pch_purchase_credit_note_id' => 96,
                'pch_purchase_debit_note_id' => 96,
                'pch_purchase_invoice_id' => 96,
                'flag_delete' => true,
            ),
            96 => 
            array (
                'id' => 97,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 97,
                'pch_provider_payment_id' => 97,
                'pch_purchase_credit_note_id' => 97,
                'pch_purchase_debit_note_id' => 97,
                'pch_purchase_invoice_id' => 97,
                'flag_delete' => true,
            ),
            97 => 
            array (
                'id' => 98,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 98,
                'pch_provider_payment_id' => 98,
                'pch_purchase_credit_note_id' => 98,
                'pch_purchase_debit_note_id' => 98,
                'pch_purchase_invoice_id' => 98,
                'flag_delete' => true,
            ),
            98 => 
            array (
                'id' => 99,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 99,
                'pch_provider_payment_id' => 99,
                'pch_purchase_credit_note_id' => 99,
                'pch_purchase_debit_note_id' => 99,
                'pch_purchase_invoice_id' => 99,
                'flag_delete' => true,
            ),
            99 => 
            array (
                'id' => 100,
                'pch_type_provider_account_movement_id' => $faker->numberBetween(1, 2),
                'pch_provider_account_id' => 100,
                'pch_provider_payment_id' => 100,
                'pch_purchase_credit_note_id' => 100,
                'pch_purchase_debit_note_id' => 100,
                'pch_purchase_invoice_id' => 100,
                'flag_delete' => true,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_provider_account_movement')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}