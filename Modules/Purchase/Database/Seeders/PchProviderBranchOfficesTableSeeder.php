<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchProviderBranchOfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_provider_branch_offices')->delete();

        \DB::table('pch_provider_branch_offices')->insert(array (
            0 =>
            array (
                'pch_provider_id' => 1,
                'g_commune_id' => 26,
                'address' => 'Fortaleza de Ganon',
                'phone' => '',
                'email' => '',
                'default_branch_office' => false,
                'flag_delete' => false,
            ),
            1 =>
            array (
                'pch_provider_id' => 1,
                'g_commune_id' => 27,
                'address' => 'Templo de Agua',
                'phone' => '',
                'email' => '',
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            2 =>
            array (
                'pch_provider_id' => 2,
                'g_commune_id' => 26,
                'address' => 'Ramon Solar #423',
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            3 =>
            array (
                'pch_provider_id' => 3,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            4 =>
            array (
                'pch_provider_id' => 4,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            5 =>
            array (
                'pch_provider_id' => 5,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            6 =>
            array (
                'pch_provider_id' => 6,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            7 =>
            array (
                'pch_provider_id' => 7,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            8 =>
            array (
                'pch_provider_id' => 8,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            9 =>
            array (
                'pch_provider_id' => 9,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            10 =>
            array (
                'pch_provider_id' => 10,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            11 =>
            array (
                'pch_provider_id' => 11,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            12 =>
            array (
                'pch_provider_id' => 12,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            13 =>
            array (
                'pch_provider_id' => 13,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            14 =>
            array (
                'pch_provider_id' => 14,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            15 =>
            array (
                'pch_provider_id' => 15,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            16 =>
            array (
                'pch_provider_id' => 16,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            17 =>
            array (
                'pch_provider_id' => 17,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            18 =>
            array (
                'pch_provider_id' => 18,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            19 =>
            array (
                'pch_provider_id' => 19,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            20 =>
            array (
                'pch_provider_id' => 20,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            21 =>
            array (
                'pch_provider_id' => 21,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            22 =>
            array (
                'pch_provider_id' => 22,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            23 =>
            array (
                'pch_provider_id' => 23,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            24 =>
            array (
                'pch_provider_id' => 24,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            25 =>
            array (
                'pch_provider_id' => 25,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            26 =>
            array (
                'pch_provider_id' => 26,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            27 =>
            array (
                'pch_provider_id' => 27,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            28 =>
            array (
                'pch_provider_id' => 28,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            29 =>
            array (
                'pch_provider_id' => 29,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            30 =>
            array (
                'pch_provider_id' => 30,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            31 =>
            array (
                'pch_provider_id' => 31,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            32 =>
            array (
                'pch_provider_id' => 32,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            33 =>
            array (
                'pch_provider_id' => 33,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            34 =>
            array (
                'pch_provider_id' => 34,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            35 =>
            array (
                'pch_provider_id' => 35,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            36 =>
            array (
                'pch_provider_id' => 36,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            37 =>
            array (
                'pch_provider_id' => 37,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            38 =>
            array (
                'pch_provider_id' => 38,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            39 =>
            array (
                'pch_provider_id' => 39,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            40 =>
            array (
                'pch_provider_id' => 40,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            41 =>
            array (
                'pch_provider_id' => 41,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            42 =>
            array (
                'pch_provider_id' => 42,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            43 =>
            array (
                'pch_provider_id' => 43,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            44 =>
            array (
                'pch_provider_id' => 44,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            45 =>
            array (
                'pch_provider_id' => 45,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            46 =>
            array (
                'pch_provider_id' => 46,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            47 =>
            array (
                'pch_provider_id' => 47,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            48 =>
            array (
                'pch_provider_id' => 48,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            49 =>
            array (
                'pch_provider_id' => 49,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            50 =>
            array (
                'pch_provider_id' => 50,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            51 =>
            array (
                'pch_provider_id' => 51,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            52 =>
            array (
                'pch_provider_id' => 52,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            53 =>
            array (
                'pch_provider_id' => 53,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            54 =>
            array (
                'pch_provider_id' => 54,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            55 =>
            array (
                'pch_provider_id' => 55,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            56 =>
            array (
                'pch_provider_id' => 56,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            57 =>
            array (
                'pch_provider_id' => 57,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            58 =>
            array (
                'pch_provider_id' => 58,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            59 =>
            array (
                'pch_provider_id' => 59,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            60 =>
            array (
                'pch_provider_id' => 60,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            61 =>
            array (
                'pch_provider_id' => 61,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            62 =>
            array (
                'pch_provider_id' => 62,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            63 =>
            array (
                'pch_provider_id' => 63,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            64 =>
            array (
                'pch_provider_id' => 64,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            65 =>
            array (
                'pch_provider_id' => 65,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            66 =>
            array (
                'pch_provider_id' => 66,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            67 =>
            array (
                'pch_provider_id' => 67,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            68 =>
            array (
                'pch_provider_id' => 68,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            69 =>
            array (
                'pch_provider_id' => 69,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            70 =>
            array (
                'pch_provider_id' => 70,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            71 =>
            array (
                'pch_provider_id' => 71,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            72 =>
            array (
                'pch_provider_id' => 72,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            73 =>
            array (
                'pch_provider_id' => 73,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            74 =>
            array (
                'pch_provider_id' => 74,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            75 =>
            array (
                'pch_provider_id' => 75,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            76 =>
            array (
                'pch_provider_id' => 76,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            77 =>
            array (
                'pch_provider_id' => 77,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            78 =>
            array (
                'pch_provider_id' => 78,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            79 =>
            array (
                'pch_provider_id' => 79,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            80 =>
            array (
                'pch_provider_id' => 80,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            81 =>
            array (
                'pch_provider_id' => 81,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            82 =>
            array (
                'pch_provider_id' => 82,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            83 =>
            array (
                'pch_provider_id' => 83,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            84 =>
            array (
                'pch_provider_id' => 84,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            85 =>
            array (
                'pch_provider_id' => 85,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            86 =>
            array (
                'pch_provider_id' => 86,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            87 =>
            array (
                'pch_provider_id' => 87,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            88 =>
            array (
                'pch_provider_id' => 88,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            89 =>
            array (
                'pch_provider_id' => 89,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            90 =>
            array (
                'pch_provider_id' => 90,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            91 =>
            array (
                'pch_provider_id' => 91,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            92 =>
            array (
                'pch_provider_id' => 92,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            93 =>
            array (
                'pch_provider_id' => 93,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            94 =>
            array (
                'pch_provider_id' => 94,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            95 =>
            array (
                'pch_provider_id' => 95,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            96 =>
            array (
                'pch_provider_id' => 96,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            97 =>
            array (
                'pch_provider_id' => 97,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            98 =>
            array (
                'pch_provider_id' => 98,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            99 =>
            array (
                'pch_provider_id' => 99,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
            100 =>
            array (
                'pch_provider_id' => 100,
                'g_commune_id' => 26,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'default_branch_office' => true,
                'flag_delete' => false,
            ),
        ));


        $now = \Carbon\Carbon::now();
        \DB::table('pch_provider_branch_offices')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
