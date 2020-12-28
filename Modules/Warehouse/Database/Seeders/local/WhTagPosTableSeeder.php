<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class WhTagPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_tag_pos')->delete();

        \DB::table('wh_tag_pos')->insert(array (
            0 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            1 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            2 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            3 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            4 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            5 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            6 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            7 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            8 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            9 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            10 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            11 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            12 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            13 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            14 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            15 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            16 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            17 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            18 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            19 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            20 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            21 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            22 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            23 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            24 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            25 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            26 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            27 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            28 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            29 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            30 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            31 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            32 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            33 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            34 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            35 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            36 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            37 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            38 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            39 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            40 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            41 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            42 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            43 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            44 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            45 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            46 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            47 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            48 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            49 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            50 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            51 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            52 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            53 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            54 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            55 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            56 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            57 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            58 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            59 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            60 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            61 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            62 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            63 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            64 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            65 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            66 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            67 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            68 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            69 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            70 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            71 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            72 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            73 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            74 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            75 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            76 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            77 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            78 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            79 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            80 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            81 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            82 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            83 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            84 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            85 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            86 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            87 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            88 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            89 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            90 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            91 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            92 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            93 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            94 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            95 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            96 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            97 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
            98 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => true,
            ),
            99 =>
            array (
                'tag' => $faker->word,
                'description' => $faker->sentences(3, true),
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_tag_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
