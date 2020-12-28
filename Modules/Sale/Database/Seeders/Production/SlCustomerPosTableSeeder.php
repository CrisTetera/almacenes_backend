<?php

namespace Modules\Sale\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class SlCustomerPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('sl_customer_pos')->delete();

        \DB::table('sl_customer_pos')->insert(array (
            // 0 =>
            // array (
            //     'rut' => '76430498-5',
            //     'business_name' => $faker->company,
            //     'alias_name' => $faker->name,
            //     'commercial_business' => $faker->realText(60),
            //     'g_commune_id' => '15','g_commune_id' => '15',
            //     'flag_delete' => false,
            //     'address' => $faker->address,
            //     'email' => $faker->email,
            //     'phone_number' => $faker->e164PhoneNumber,
            //     'is_company' => false
            // ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('sl_customer')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
