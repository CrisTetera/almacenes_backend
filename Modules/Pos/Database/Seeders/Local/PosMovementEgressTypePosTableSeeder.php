<?php

namespace Modules\Pos\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class PosMovementEgressTypePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_movement_egress_type_pos')->delete();
        
        \DB::table('pos_movement_egress_type_pos')->insert(array (
            0 => 
            array (
                // 'id' => 1,
                'type' => $faker->word,
            ),
            1 => 
            array (
                // 'id' => 2,
                'type' => $faker->word,
            ),
            2 => 
            array (
                // 'id' => 3,
                'type' => $faker->word,
            ),
            3 => 
            array (
                // 'id' => 4,
                'type' => $faker->word,
            ),
            4 => 
            array (
                // 'id' => 5,
                'type' => $faker->word,
            ),
            5 => 
            array (
                // 'id' => 6,
                'type' => $faker->word,
            ),
            6 => 
            array (
                // 'id' => 7,
                'type' => $faker->word,
            ),
            7 => 
            array (
                // 'id' => 8,
                'type' => $faker->word,
            ),
            8 => 
            array (
                // 'id' => 9,
                'type' => $faker->word,
            ),
            9 => 
            array (
                // 'id' => 10,
                'type' => $faker->word,
            ),
            10 => 
            array (
                // 'id' => 11,
                'type' => $faker->word,
            ),
            11 => 
            array (
                // 'id' => 12,
                'type' => $faker->word,
            ),
            12 => 
            array (
                // 'id' => 13,
                'type' => $faker->word,
            ),
            13 => 
            array (
                // 'id' => 14,
                'type' => $faker->word,
            ),
            14 => 
            array (
                // 'id' => 15,
                'type' => $faker->word,
            ),
            15 => 
            array (
                // 'id' => 16,
                'type' => $faker->word,
            ),
            16 => 
            array (
                // 'id' => 17,
                'type' => $faker->word,
            ),
            17 => 
            array (
                // 'id' => 18,
                'type' => $faker->word,
            ),
            18 => 
            array (
                // 'id' => 19,
                'type' => $faker->word,
            ),
            19 => 
            array (
                // 'id' => 20,
                'type' => $faker->word,
            ),
            20 => 
            array (
                // 'id' => 21,
                'type' => $faker->word,
            ),
            21 => 
            array (
                // 'id' => 22,
                'type' => $faker->word,
            ),
            22 => 
            array (
                // 'id' => 23,
                'type' => $faker->word,
            ),
            23 => 
            array (
                // 'id' => 24,
                'type' => $faker->word,
            ),
            24 => 
            array (
                // 'id' => 25,
                'type' => $faker->word,
            ),
            25 => 
            array (
                // 'id' => 26,
                'type' => $faker->word,
            ),
            26 => 
            array (
                // 'id' => 27,
                'type' => $faker->word,
            ),
            27 => 
            array (
                // 'id' => 28,
                'type' => $faker->word,
            ),
            28 => 
            array (
                // 'id' => 29,
                'type' => $faker->word,
            ),
            29 => 
            array (
                // 'id' => 30,
                'type' => $faker->word,
            ),
            30 => 
            array (
                // 'id' => 31,
                'type' => $faker->word,
            ),
            31 => 
            array (
                // 'id' => 32,
                'type' => $faker->word,
            ),
            32 => 
            array (
                // 'id' => 33,
                'type' => $faker->word,
            ),
            33 => 
            array (
                // 'id' => 34,
                'type' => $faker->word,
            ),
            34 => 
            array (
                // 'id' => 35,
                'type' => $faker->word,
            ),
            35 => 
            array (
                // 'id' => 36,
                'type' => $faker->word,
            ),
            36 => 
            array (
                // 'id' => 37,
                'type' => $faker->word,
            ),
            37 => 
            array (
                // 'id' => 38,
                'type' => $faker->word,
            ),
            38 => 
            array (
                // 'id' => 39,
                'type' => $faker->word,
            ),
            39 => 
            array (
                // 'id' => 40,
                'type' => $faker->word,
            ),
            40 => 
            array (
                // 'id' => 41,
                'type' => $faker->word,
            ),
            41 => 
            array (
                // 'id' => 42,
                'type' => $faker->word,
            ),
            42 => 
            array (
                // 'id' => 43,
                'type' => $faker->word,
            ),
            43 => 
            array (
                // 'id' => 44,
                'type' => $faker->word,
            ),
            44 => 
            array (
                // 'id' => 45,
                'type' => $faker->word,
            ),
            45 => 
            array (
                // 'id' => 46,
                'type' => $faker->word,
            ),
            46 => 
            array (
                // 'id' => 47,
                'type' => $faker->word,
            ),
            47 => 
            array (
                // 'id' => 48,
                'type' => $faker->word,
            ),
            48 => 
            array (
                // 'id' => 49,
                'type' => $faker->word,
            ),
            49 => 
            array (
                // 'id' => 50,
                'type' => $faker->word,
            ),
            50 => 
            array (
                // 'id' => 51,
                'type' => $faker->word,
            ),
            51 => 
            array (
                // 'id' => 52,
                'type' => $faker->word,
            ),
            52 => 
            array (
                // 'id' => 53,
                'type' => $faker->word,
            ),
            53 => 
            array (
                // 'id' => 54,
                'type' => $faker->word,
            ),
            54 => 
            array (
                // 'id' => 55,
                'type' => $faker->word,
            ),
            55 => 
            array (
                // 'id' => 56,
                'type' => $faker->word,
            ),
            56 => 
            array (
                // 'id' => 57,
                'type' => $faker->word,
            ),
            57 => 
            array (
                // 'id' => 58,
                'type' => $faker->word,
            ),
            58 => 
            array (
                // 'id' => 59,
                'type' => $faker->word,
            ),
            59 => 
            array (
                // 'id' => 60,
                'type' => $faker->word,
            ),
            60 => 
            array (
                // 'id' => 61,
                'type' => $faker->word,
            ),
            61 => 
            array (
                // 'id' => 62,
                'type' => $faker->word,
            ),
            62 => 
            array (
                // 'id' => 63,
                'type' => $faker->word,
            ),
            63 => 
            array (
                // 'id' => 64,
                'type' => $faker->word,
            ),
            64 => 
            array (
                // 'id' => 65,
                'type' => $faker->word,
            ),
            65 => 
            array (
                // 'id' => 66,
                'type' => $faker->word,
            ),
            66 => 
            array (
                // 'id' => 67,
                'type' => $faker->word,
            ),
            67 => 
            array (
                // 'id' => 68,
                'type' => $faker->word,
            ),
            68 => 
            array (
                // 'id' => 69,
                'type' => $faker->word,
            ),
            69 => 
            array (
                // 'id' => 70,
                'type' => $faker->word,
            ),
            70 => 
            array (
                // 'id' => 71,
                'type' => $faker->word,
            ),
            71 => 
            array (
                // 'id' => 72,
                'type' => $faker->word,
            ),
            72 => 
            array (
                // 'id' => 73,
                'type' => $faker->word,
            ),
            73 => 
            array (
                // 'id' => 74,
                'type' => $faker->word,
            ),
            74 => 
            array (
                // 'id' => 75,
                'type' => $faker->word,
            ),
            75 => 
            array (
                // 'id' => 76,
                'type' => $faker->word,
            ),
            76 => 
            array (
                // 'id' => 77,
                'type' => $faker->word,
            ),
            77 => 
            array (
                // 'id' => 78,
                'type' => $faker->word,
            ),
            78 => 
            array (
                // 'id' => 79,
                'type' => $faker->word,
            ),
            79 => 
            array (
                // 'id' => 80,
                'type' => $faker->word,
            ),
            80 => 
            array (
                // 'id' => 81,
                'type' => $faker->word,
            ),
            81 => 
            array (
                // 'id' => 82,
                'type' => $faker->word,
            ),
            82 => 
            array (
                // 'id' => 83,
                'type' => $faker->word,
            ),
            83 => 
            array (
                // 'id' => 84,
                'type' => $faker->word,
            ),
            84 => 
            array (
                // 'id' => 85,
                'type' => $faker->word,
            ),
            85 => 
            array (
                // 'id' => 86,
                'type' => $faker->word,
            ),
            86 => 
            array (
                // 'id' => 87,
                'type' => $faker->word,
            ),
            87 => 
            array (
                // 'id' => 88,
                'type' => $faker->word,
            ),
            88 => 
            array (
                // 'id' => 89,
                'type' => $faker->word,
            ),
            89 => 
            array (
                // 'id' => 90,
                'type' => $faker->word,
            ),
            90 => 
            array (
                // 'id' => 91,
                'type' => $faker->word,
            ),
            91 => 
            array (
                // 'id' => 92,
                'type' => $faker->word,
            ),
            92 => 
            array (
                // 'id' => 93,
                'type' => $faker->word,
            ),
            93 => 
            array (
                // 'id' => 94,
                'type' => $faker->word,
            ),
            94 => 
            array (
                // 'id' => 95,
                'type' => $faker->word,
            ),
            95 => 
            array (
                // 'id' => 96,
                'type' => $faker->word,
            ),
            96 => 
            array (
                // 'id' => 97,
                'type' => $faker->word,
            ),
            97 => 
            array (
                // 'id' => 98,
                'type' => $faker->word,
            ),
            98 => 
            array (
                // 'id' => 99,
                'type' => $faker->word,
            ),
            99 => 
            array (
                // 'id' => 100,
                'type' => $faker->word,
            ),
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('pos_movement_egress_type_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
