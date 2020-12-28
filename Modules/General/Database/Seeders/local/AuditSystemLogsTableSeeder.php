<?php

namespace Modules\General\Database\Seeders\local;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuditSystemLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('audit_system_logs')->delete();
        
        \DB::table('audit_system_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'g_user_id' => 1,
                'action' => $faker->sentence(8),
            ),
            1 => 
            array (
                'id' => 2,
                'g_user_id' => 2,
                'action' => $faker->sentence(8),
            ),
            2 => 
            array (
                'id' => 3,
                'g_user_id' => 3,
                'action' => $faker->sentence(8),
            ),
            3 => 
            array (
                'id' => 4,
                'g_user_id' => 4,
                'action' => $faker->sentence(8),
            ),
            4 => 
            array (
                'id' => 5,
                'g_user_id' => 5,
                'action' => $faker->sentence(8),
            ),
            5 => 
            array (
                'id' => 6,
                'g_user_id' => 6,
                'action' => $faker->sentence(8),
            ),
            6 => 
            array (
                'id' => 7,
                'g_user_id' => 7,
                'action' => $faker->sentence(8),
            ),
            7 => 
            array (
                'id' => 8,
                'g_user_id' => 8,
                'action' => $faker->sentence(8),
            ),
            8 => 
            array (
                'id' => 9,
                'g_user_id' => 9,
                'action' => $faker->sentence(8),
            ),
            9 => 
            array (
                'id' => 10,
                'g_user_id' => 10,
                'action' => $faker->sentence(8),
            ),
            10 => 
            array (
                'id' => 11,
                'g_user_id' => 11,
                'action' => $faker->sentence(8),
            ),
            11 => 
            array (
                'id' => 12,
                'g_user_id' => 12,
                'action' => $faker->sentence(8),
            ),
            12 => 
            array (
                'id' => 13,
                'g_user_id' => 13,
                'action' => $faker->sentence(8),
            ),
            13 => 
            array (
                'id' => 14,
                'g_user_id' => 14,
                'action' => $faker->sentence(8),
            ),
            14 => 
            array (
                'id' => 15,
                'g_user_id' => 15,
                'action' => $faker->sentence(8),
            ),
            15 => 
            array (
                'id' => 16,
                'g_user_id' => 16,
                'action' => $faker->sentence(8),
            ),
            16 => 
            array (
                'id' => 17,
                'g_user_id' => 17,
                'action' => $faker->sentence(8),
            ),
            17 => 
            array (
                'id' => 18,
                'g_user_id' => 18,
                'action' => $faker->sentence(8),
            ),
            18 => 
            array (
                'id' => 19,
                'g_user_id' => 19,
                'action' => $faker->sentence(8),
            ),
            19 => 
            array (
                'id' => 20,
                'g_user_id' => 20,
                'action' => $faker->sentence(8),
            ),
            20 => 
            array (
                'id' => 21,
                'g_user_id' => 21,
                'action' => $faker->sentence(8),
            ),
            21 => 
            array (
                'id' => 22,
                'g_user_id' => 22,
                'action' => $faker->sentence(8),
            ),
            22 => 
            array (
                'id' => 23,
                'g_user_id' => 23,
                'action' => $faker->sentence(8),
            ),
            23 => 
            array (
                'id' => 24,
                'g_user_id' => 24,
                'action' => $faker->sentence(8),
            ),
            24 => 
            array (
                'id' => 25,
                'g_user_id' => 25,
                'action' => $faker->sentence(8),
            ),
            25 => 
            array (
                'id' => 26,
                'g_user_id' => 26,
                'action' => $faker->sentence(8),
            ),
            26 => 
            array (
                'id' => 27,
                'g_user_id' => 27,
                'action' => $faker->sentence(8),
            ),
            27 => 
            array (
                'id' => 28,
                'g_user_id' => 28,
                'action' => $faker->sentence(8),
            ),
            28 => 
            array (
                'id' => 29,
                'g_user_id' => 29,
                'action' => $faker->sentence(8),
            ),
            29 => 
            array (
                'id' => 30,
                'g_user_id' => 30,
                'action' => $faker->sentence(8),
            ),
            30 => 
            array (
                'id' => 31,
                'g_user_id' => 31,
                'action' => $faker->sentence(8),
            ),
            31 => 
            array (
                'id' => 32,
                'g_user_id' => 32,
                'action' => $faker->sentence(8),
            ),
            32 => 
            array (
                'id' => 33,
                'g_user_id' => 33,
                'action' => $faker->sentence(8),
            ),
            33 => 
            array (
                'id' => 34,
                'g_user_id' => 34,
                'action' => $faker->sentence(8),
            ),
            34 => 
            array (
                'id' => 35,
                'g_user_id' => 35,
                'action' => $faker->sentence(8),
            ),
            35 => 
            array (
                'id' => 36,
                'g_user_id' => 36,
                'action' => $faker->sentence(8),
            ),
            36 => 
            array (
                'id' => 37,
                'g_user_id' => 37,
                'action' => $faker->sentence(8),
            ),
            37 => 
            array (
                'id' => 38,
                'g_user_id' => 38,
                'action' => $faker->sentence(8),
            ),
            38 => 
            array (
                'id' => 39,
                'g_user_id' => 39,
                'action' => $faker->sentence(8),
            ),
            39 => 
            array (
                'id' => 40,
                'g_user_id' => 40,
                'action' => $faker->sentence(8),
            ),
            40 => 
            array (
                'id' => 41,
                'g_user_id' => 41,
                'action' => $faker->sentence(8),
            ),
            41 => 
            array (
                'id' => 42,
                'g_user_id' => 42,
                'action' => $faker->sentence(8),
            ),
            42 => 
            array (
                'id' => 43,
                'g_user_id' => 43,
                'action' => $faker->sentence(8),
            ),
            43 => 
            array (
                'id' => 44,
                'g_user_id' => 44,
                'action' => $faker->sentence(8),
            ),
            44 => 
            array (
                'id' => 45,
                'g_user_id' => 45,
                'action' => $faker->sentence(8),
            ),
            45 => 
            array (
                'id' => 46,
                'g_user_id' => 46,
                'action' => $faker->sentence(8),
            ),
            46 => 
            array (
                'id' => 47,
                'g_user_id' => 47,
                'action' => $faker->sentence(8),
            ),
            47 => 
            array (
                'id' => 48,
                'g_user_id' => 48,
                'action' => $faker->sentence(8),
            ),
            48 => 
            array (
                'id' => 49,
                'g_user_id' => 49,
                'action' => $faker->sentence(8),
            ),
            49 => 
            array (
                'id' => 50,
                'g_user_id' => 50,
                'action' => $faker->sentence(8),
            ),
            50 => 
            array (
                'id' => 51,
                'g_user_id' => 51,
                'action' => $faker->sentence(8),
            ),
            51 => 
            array (
                'id' => 52,
                'g_user_id' => 52,
                'action' => $faker->sentence(8),
            ),
            52 => 
            array (
                'id' => 53,
                'g_user_id' => 53,
                'action' => $faker->sentence(8),
            ),
            53 => 
            array (
                'id' => 54,
                'g_user_id' => 54,
                'action' => $faker->sentence(8),
            ),
            54 => 
            array (
                'id' => 55,
                'g_user_id' => 55,
                'action' => $faker->sentence(8),
            ),
            55 => 
            array (
                'id' => 56,
                'g_user_id' => 56,
                'action' => $faker->sentence(8),
            ),
            56 => 
            array (
                'id' => 57,
                'g_user_id' => 57,
                'action' => $faker->sentence(8),
            ),
            57 => 
            array (
                'id' => 58,
                'g_user_id' => 58,
                'action' => $faker->sentence(8),
            ),
            58 => 
            array (
                'id' => 59,
                'g_user_id' => 59,
                'action' => $faker->sentence(8),
            ),
            59 => 
            array (
                'id' => 60,
                'g_user_id' => 60,
                'action' => $faker->sentence(8),
            ),
            60 => 
            array (
                'id' => 61,
                'g_user_id' => 61,
                'action' => $faker->sentence(8),
            ),
            61 => 
            array (
                'id' => 62,
                'g_user_id' => 62,
                'action' => $faker->sentence(8),
            ),
            62 => 
            array (
                'id' => 63,
                'g_user_id' => 63,
                'action' => $faker->sentence(8),
            ),
            63 => 
            array (
                'id' => 64,
                'g_user_id' => 64,
                'action' => $faker->sentence(8),
            ),
            64 => 
            array (
                'id' => 65,
                'g_user_id' => 65,
                'action' => $faker->sentence(8),
            ),
            65 => 
            array (
                'id' => 66,
                'g_user_id' => 66,
                'action' => $faker->sentence(8),
            ),
            66 => 
            array (
                'id' => 67,
                'g_user_id' => 67,
                'action' => $faker->sentence(8),
            ),
            67 => 
            array (
                'id' => 68,
                'g_user_id' => 68,
                'action' => $faker->sentence(8),
            ),
            68 => 
            array (
                'id' => 69,
                'g_user_id' => 69,
                'action' => $faker->sentence(8),
            ),
            69 => 
            array (
                'id' => 70,
                'g_user_id' => 70,
                'action' => $faker->sentence(8),
            ),
            70 => 
            array (
                'id' => 71,
                'g_user_id' => 71,
                'action' => $faker->sentence(8),
            ),
            71 => 
            array (
                'id' => 72,
                'g_user_id' => 72,
                'action' => $faker->sentence(8),
            ),
            72 => 
            array (
                'id' => 73,
                'g_user_id' => 73,
                'action' => $faker->sentence(8),
            ),
            73 => 
            array (
                'id' => 74,
                'g_user_id' => 74,
                'action' => $faker->sentence(8),
            ),
            74 => 
            array (
                'id' => 75,
                'g_user_id' => 75,
                'action' => $faker->sentence(8),
            ),
            75 => 
            array (
                'id' => 76,
                'g_user_id' => 76,
                'action' => $faker->sentence(8),
            ),
            76 => 
            array (
                'id' => 77,
                'g_user_id' => 77,
                'action' => $faker->sentence(8),
            ),
            77 => 
            array (
                'id' => 78,
                'g_user_id' => 78,
                'action' => $faker->sentence(8),
            ),
            78 => 
            array (
                'id' => 79,
                'g_user_id' => 79,
                'action' => $faker->sentence(8),
            ),
            79 => 
            array (
                'id' => 80,
                'g_user_id' => 80,
                'action' => $faker->sentence(8),
            ),
            80 => 
            array (
                'id' => 81,
                'g_user_id' => 81,
                'action' => $faker->sentence(8),
            ),
            81 => 
            array (
                'id' => 82,
                'g_user_id' => 82,
                'action' => $faker->sentence(8),
            ),
            82 => 
            array (
                'id' => 83,
                'g_user_id' => 83,
                'action' => $faker->sentence(8),
            ),
            83 => 
            array (
                'id' => 84,
                'g_user_id' => 84,
                'action' => $faker->sentence(8),
            ),
            84 => 
            array (
                'id' => 85,
                'g_user_id' => 85,
                'action' => $faker->sentence(8),
            ),
            85 => 
            array (
                'id' => 86,
                'g_user_id' => 86,
                'action' => $faker->sentence(8),
            ),
            86 => 
            array (
                'id' => 87,
                'g_user_id' => 87,
                'action' => $faker->sentence(8),
            ),
            87 => 
            array (
                'id' => 88,
                'g_user_id' => 88,
                'action' => $faker->sentence(8),
            ),
            88 => 
            array (
                'id' => 89,
                'g_user_id' => 89,
                'action' => $faker->sentence(8),
            ),
            89 => 
            array (
                'id' => 90,
                'g_user_id' => 90,
                'action' => $faker->sentence(8),
            ),
            90 => 
            array (
                'id' => 91,
                'g_user_id' => 91,
                'action' => $faker->sentence(8),
            ),
            91 => 
            array (
                'id' => 92,
                'g_user_id' => 92,
                'action' => $faker->sentence(8),
            ),
            92 => 
            array (
                'id' => 93,
                'g_user_id' => 93,
                'action' => $faker->sentence(8),
            ),
            93 => 
            array (
                'id' => 94,
                'g_user_id' => 94,
                'action' => $faker->sentence(8),
            ),
            94 => 
            array (
                'id' => 95,
                'g_user_id' => 95,
                'action' => $faker->sentence(8),
            ),
            95 => 
            array (
                'id' => 96,
                'g_user_id' => 96,
                'action' => $faker->sentence(8),
            ),
            96 => 
            array (
                'id' => 97,
                'g_user_id' => 97,
                'action' => $faker->sentence(8),
            ),
            97 => 
            array (
                'id' => 98,
                'g_user_id' => 98,
                'action' => $faker->sentence(8),
            ),
            98 => 
            array (
                'id' => 99,
                'g_user_id' => 99,
                'action' => $faker->sentence(8),
            ),
            99 => 
            array (
                'id' => 100,
                'g_user_id' => 100,
                'action' => $faker->sentence(8),
            ),
        ));

        
        $now = \Carbon\Carbon::now();
        \DB::table('audit_system_logs')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}