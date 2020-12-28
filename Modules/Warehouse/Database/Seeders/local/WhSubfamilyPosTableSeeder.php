<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class WhSubfamilyPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_subfamily_pos')->delete();

        \DB::table('wh_subfamily_pos')->insert(array (
            0 =>
            array (
                'wh_family_id' => 1,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            1 =>
            array (
                'wh_family_id' => 1,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            2 =>
            array (
                'wh_family_id' => 2,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            3 =>
            array (
                'wh_family_id' => 4,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            4 =>
            array (
                'wh_family_id' => 5,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            5 =>
            array (
                'wh_family_id' => 6,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            6 =>
            array (
                'wh_family_id' => 7,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            7 =>
            array (
                'wh_family_id' => 8,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            8 =>
            array (
                'wh_family_id' => 9,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            9 =>
            array (
                'wh_family_id' => 10,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            10 =>
            array (
                'wh_family_id' => 11,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            11 =>
            array (
                'wh_family_id' => 12,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            12 =>
            array (
                'wh_family_id' => 13,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            13 =>
            array (
                'wh_family_id' => 14,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            14 =>
            array (
                'wh_family_id' => 15,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            15 =>
            array (
                'wh_family_id' => 16,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            16 =>
            array (
                'wh_family_id' => 17,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            17 =>
            array (
                'wh_family_id' => 18,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            18 =>
            array (
                'wh_family_id' => 19,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            19 =>
            array (
                'wh_family_id' => 20,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            20 =>
            array (
                'wh_family_id' => 21,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            21 =>
            array (
                'wh_family_id' => 22,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            22 =>
            array (
                'wh_family_id' => 23,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            23 =>
            array (
                'wh_family_id' => 24,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            24 =>
            array (
                'wh_family_id' => 25,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            25 =>
            array (
                'wh_family_id' => 26,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            26 =>
            array (
                'wh_family_id' => 27,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            27 =>
            array (
                'wh_family_id' => 28,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            28 =>
            array (
                'wh_family_id' => 29,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            29 =>
            array (
                'wh_family_id' => 30,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            30 =>
            array (
                'wh_family_id' => 31,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            31 =>
            array (
                'wh_family_id' => 32,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            32 =>
            array (
                'wh_family_id' => 33,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            33 =>
            array (
                'wh_family_id' => 34,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            34 =>
            array (
                'wh_family_id' => 35,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            35 =>
            array (
                'wh_family_id' => 36,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            36 =>
            array (
                'wh_family_id' => 37,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            37 =>
            array (
                'wh_family_id' => 38,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            38 =>
            array (
                'wh_family_id' => 39,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            39 =>
            array (
                'wh_family_id' => 40,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            40 =>
            array (
                'wh_family_id' => 41,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            41 =>
            array (
                'wh_family_id' => 42,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            42 =>
            array (
                'wh_family_id' => 43,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            43 =>
            array (
                'wh_family_id' => 44,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            44 =>
            array (
                'wh_family_id' => 45,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            45 =>
            array (
                'wh_family_id' => 46,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            46 =>
            array (
                'wh_family_id' => 47,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            47 =>
            array (
                'wh_family_id' => 48,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            48 =>
            array (
                'wh_family_id' => 49,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            49 =>
            array (
                'wh_family_id' => 50,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            50 =>
            array (
                'wh_family_id' => 51,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            51 =>
            array (
                'wh_family_id' => 52,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            52 =>
            array (
                'wh_family_id' => 53,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            53 =>
            array (
                'wh_family_id' => 54,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            54 =>
            array (
                'wh_family_id' => 55,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            55 =>
            array (
                'wh_family_id' => 56,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            56 =>
            array (
                'wh_family_id' => 57,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            57 =>
            array (
                'wh_family_id' => 58,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            58 =>
            array (
                'wh_family_id' => 59,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            59 =>
            array (
                'wh_family_id' => 60,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            60 =>
            array (
                'wh_family_id' => 61,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            61 =>
            array (
                'wh_family_id' => 62,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            62 =>
            array (
                'wh_family_id' => 63,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            63 =>
            array (
                'wh_family_id' => 64,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            64 =>
            array (
                'wh_family_id' => 65,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            65 =>
            array (
                'wh_family_id' => 66,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            66 =>
            array (
                'wh_family_id' => 67,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            67 =>
            array (
                'wh_family_id' => 68,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            68 =>
            array (
                'wh_family_id' => 69,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            69 =>
            array (
                'wh_family_id' => 70,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            70 =>
            array (
                'wh_family_id' => 71,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            71 =>
            array (
                'wh_family_id' => 72,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            72 =>
            array (
                'wh_family_id' => 73,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            73 =>
            array (
                'wh_family_id' => 74,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            74 =>
            array (
                'wh_family_id' => 75,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            75 =>
            array (
                'wh_family_id' => 76,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            76 =>
            array (
                'wh_family_id' => 77,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            77 =>
            array (
                'wh_family_id' => 78,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            78 =>
            array (
                'wh_family_id' => 79,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            79 =>
            array (
                'wh_family_id' => 80,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            80 =>
            array (
                'wh_family_id' => 81,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            81 =>
            array (
                'wh_family_id' => 82,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            82 =>
            array (
                'wh_family_id' => 83,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            83 =>
            array (
                'wh_family_id' => 84,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            84 =>
            array (
                'wh_family_id' => 85,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            85 =>
            array (
                'wh_family_id' => 86,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            86 =>
            array (
                'wh_family_id' => 87,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            87 =>
            array (
                'wh_family_id' => 88,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            88 =>
            array (
                'wh_family_id' => 89,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            89 =>
            array (
                'wh_family_id' => 90,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            90 =>
            array (
                'wh_family_id' => 91,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            91 =>
            array (
                'wh_family_id' => 92,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            92 =>
            array (
                'wh_family_id' => 93,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            93 =>
            array (
                'wh_family_id' => 94,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            94 =>
            array (
                'wh_family_id' => 95,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            95 =>
            array (
                'wh_family_id' => 96,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            96 =>
            array (
                'wh_family_id' => 97,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            97 =>
            array (
                'wh_family_id' => 98,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            98 =>
            array (
                'wh_family_id' => 99,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            99 =>
            array (
                'wh_family_id' => 100,
                'subfamily' => $faker->sentence(3),
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_subfamily_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
