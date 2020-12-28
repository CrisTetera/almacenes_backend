<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class WhFamilyPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_family_pos')->delete();

        \DB::table('wh_family_pos')->insert(array (
            0 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            1 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            2 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            3 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            4 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            5 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            6 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            7 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            8 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            9 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            10 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            11 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            12 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            13 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            14 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            15 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            16 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            17 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            18 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            19 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            20 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            21 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            22 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            23 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            24 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            25 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            26 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            27 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            28 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            29 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            30 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            31 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            32 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            33 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            34 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            35 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            36 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            37 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            38 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            39 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            40 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            41 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            42 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            43 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            44 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            45 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            46 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            47 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            48 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            49 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            50 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            51 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            52 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            53 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            54 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            55 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            56 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            57 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            58 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            59 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            60 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            61 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            62 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            63 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            64 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            65 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            66 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            67 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            68 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            69 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            70 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            71 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            72 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            73 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            74 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            75 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            76 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            77 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            78 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            79 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            80 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            81 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            82 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            83 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            84 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            85 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            86 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            87 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            88 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            89 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            90 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            91 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            92 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            93 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            94 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            95 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            96 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => false,
            ),
            97 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            98 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
            99 =>
            array (
                'family' => $faker->sentence(3),
                'flag_delete' => true,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_family_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
