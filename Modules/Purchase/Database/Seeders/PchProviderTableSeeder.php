<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchProviderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_provider')->delete();

        \DB::table('pch_provider')->insert(array (
            0 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '19078801-6',
                'business_name' => 'Hyrule',
                'flag_delete' => false,
                'alias_name' => 'Hyrule',
            ),
            1 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '21160243-0',
                'business_name' => 'Innlab',
                'flag_delete' => false,
                'alias_name' => 'Innlab',
            ),
            2 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '23424266-0',
                'business_name' => 'Some Provider',
                'flag_delete' => false,
                'alias_name' => 'Some Provider',
            ),
            3 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000000-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            4 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000050-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            5 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000100-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            6 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000150-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            7 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000200-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            8 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000250-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            9 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000300-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            10 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000350-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            11 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000400-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            12 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000450-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            13 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000500-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            14 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000550-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            15 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000600-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            16 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000650-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            17 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000700-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            18 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000750-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            19 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000800-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            20 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000850-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            21 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000900-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            22 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10000950-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            23 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001000-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            24 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001050-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            25 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001100-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            26 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001150-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            27 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001200-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            28 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001250-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            29 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001300-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            30 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001350-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            31 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001400-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            32 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001450-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            33 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001500-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            34 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001550-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            35 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001600-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            36 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001650-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            37 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001700-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            38 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001750-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            39 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001800-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            40 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001850-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            41 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001900-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            42 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10001950-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            43 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002000-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            44 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002050-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            45 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002100-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            46 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002150-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            47 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002200-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            48 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002250-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            49 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002300-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            50 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002350-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            51 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002400-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            52 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002450-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            53 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002500-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            54 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002550-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            55 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002600-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            56 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002650-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            57 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002700-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            58 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002750-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            59 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002800-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            60 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002850-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            61 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002900-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            62 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10002950-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            63 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003000-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            64 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003050-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            65 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003100-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            66 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003150-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            67 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003200-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            68 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003250-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            69 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003300-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            70 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003350-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            71 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003400-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            72 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003450-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            73 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003500-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            74 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003550-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            75 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003600-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            76 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003650-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            77 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003700-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            78 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003750-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            79 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003800-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            80 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003850-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            81 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003900-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            82 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10003950-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            83 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004000-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            84 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004050-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            85 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004100-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            86 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004150-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            87 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004200-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            88 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004250-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            89 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004300-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            90 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004350-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            91 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004400-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            92 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004450-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            93 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004500-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            94 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004550-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            95 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004600-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            96 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004650-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            97 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004700-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            98 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004750-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
            99 =>
            array (
                'pch_provider_account_id' => 1,
                'rut' => '10004800-0',
                'business_name' => $faker->company,
                'flag_delete' => false,
                'alias_name' => $faker->company,
            ),
        ));


        $now = \Carbon\Carbon::now();
        \DB::table('pch_provider')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);


    }
}
