<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GUserPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('g_user_pos')->delete();

        \DB::table('g_user_pos')->insert(array (
            // Los tres primeros están autorizados para hacer apertura, egreso e ingreso.
            0 =>
            array (
                'hr_employee_id' => 1,
                'auth_code' => 875,
                'bar_auth_code' => 'U00000008750',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'r1E8tlto2mJsM2GnJkJBh10ADNYfA6o1du0cRkeOqn6Ig5rNubzbZBnda1TJDSm4rFQeeabHvwHuFDq9YIgmxfmxrKBBxzoyecxhqntBVzuNvJ8S5WwGyMapqPQSCRVUJaTqMJaq5xiMw6lVXOjmB1i2x16uQXI885WyYpuMSFOI7QvlGGxx981DzCCDgH2jB4NTr9A6BSzyTUNsMSpH2TU8Ygzgm7pGIaQr0kHsuTgmpG2J01V0LWAFfB6WSam',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_user')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
