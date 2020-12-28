<?php

namespace Modules\Sale\Database\Seeders\local;

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
            0 =>
            array (
                'rut' => '76430498-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15','g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => false
            ),
            1 =>
            array (
                'rut' => '8230723-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            2 =>
            array (
                'rut' => '20000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            3 =>
            array (
                'rut' => '30000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            4 =>
            array (
                'rut' => '40000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            5 =>
            array (
                'rut' => '50000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            6 =>
            array (
                'rut' => '60000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            7 =>
            array (
                'rut' => '17852816-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            8 =>
            array (
                'rut' => '21901575-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            9 =>
            array (
                'rut' => '22437035-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            10 =>
            array (
                'rut' => '10000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            11 =>
            array (
                'rut' => '11000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            12 =>
            array (
                'rut' => '12000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            13 =>
            array (
                'rut' => '13000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            14 =>
            array (
                'rut' => '14000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            15 =>
            array (
                'rut' => '15000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            16 =>
            array (
                'rut' => '16000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            17 =>
            array (
                'rut' => '17000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            18 =>
            array (
                'rut' => '18000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            19 =>
            array (
                'rut' => '19000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            20 =>
            array (
                'rut' => '20000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            21 =>
            array (
                'rut' => '21000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            22 =>
            array (
                'rut' => '22000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            23 =>
            array (
                'rut' => '23000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            24 =>
            array (
                'rut' => '24000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            25 =>
            array (
                'rut' => '25000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            26 =>
            array (
                'rut' => '26000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            27 =>
            array (
                'rut' => '27000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            28 =>
            array (
                'rut' => '28000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            29 =>
            array (
                'rut' => '29000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            30 =>
            array (
                'rut' => '30000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            31 =>
            array (
                'rut' => '31000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            32 =>
            array (
                'rut' => '32000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            33 =>
            array (
                'rut' => '33000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            34 =>
            array (
                'rut' => '34000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            35 =>
            array (
                'rut' => '35000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            36 =>
            array (
                'rut' => '36000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            37 =>
            array (
                'rut' => '37000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            38 =>
            array (
                'rut' => '38000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            39 =>
            array (
                'rut' => '39000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            40 =>
            array (
                'rut' => '40000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            41 =>
            array (
                'rut' => '41000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            42 =>
            array (
                'rut' => '42000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            43 =>
            array (
                'rut' => '43000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            44 =>
            array (
                'rut' => '44000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            45 =>
            array (
                'rut' => '45000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            46 =>
            array (
                'rut' => '46000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            47 =>
            array (
                'rut' => '47000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            48 =>
            array (
                'rut' => '48000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            49 =>
            array (
                'rut' => '49000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            50 =>
            array (
                'rut' => '50000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            51 =>
            array (
                'rut' => '51000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            52 =>
            array (
                'rut' => '52000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            53 =>
            array (
                'rut' => '53000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            54 =>
            array (
                'rut' => '54000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            55 =>
            array (
                'rut' => '55000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            56 =>
            array (
                'rut' => '56000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            57 =>
            array (
                'rut' => '57000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            58 =>
            array (
                'rut' => '58000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            59 =>
            array (
                'rut' => '59000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            60 =>
            array (
                'rut' => '60000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            61 =>
            array (
                'rut' => '61000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            62 =>
            array (
                'rut' => '62000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            63 =>
            array (
                'rut' => '63000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            64 =>
            array (
                'rut' => '64000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            65 =>
            array (
                'rut' => '65000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            66 =>
            array (
                'rut' => '66000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            67 =>
            array (
                'rut' => '67000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            68 =>
            array (
                'rut' => '68000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            69 =>
            array (
                'rut' => '69000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            70 =>
            array (
                'rut' => '70000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            71 =>
            array (
                'rut' => '71000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            72 =>
            array (
                'rut' => '72000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            73 =>
            array (
                'rut' => '73000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            74 =>
            array (
                'rut' => '74000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            75 =>
            array (
                'rut' => '75000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            76 =>
            array (
                'rut' => '76000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            77 =>
            array (
                'rut' => '77000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            78 =>
            array (
                'rut' => '78000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            79 =>
            array (
                'rut' => '79000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            80 =>
            array (
                'rut' => '80000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            81 =>
            array (
                'rut' => '81000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            82 =>
            array (
                'rut' => '82000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            83 =>
            array (
                'rut' => '83000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            84 =>
            array (
                'rut' => '84000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            85 =>
            array (
                'rut' => '85000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            86 =>
            array (
                'rut' => '86000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            87 =>
            array (
                'rut' => '87000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            88 =>
            array (
                'rut' => '88000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            89 =>
            array (
                'rut' => '89000000-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            90 =>
            array (
                'rut' => '90000000-1',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            91 =>
            array (
                'rut' => '91000000-2',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            92 =>
            array (
                'rut' => '92000000-3',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            93 =>
            array (
                'rut' => '93000000-4',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            94 =>
            array (
                'rut' => '94000000-5',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            95 =>
            array (
                'rut' => '95000000-6',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            96 =>
            array (
                'rut' => '96000000-7',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            97 =>
            array (
                'rut' => '97000000-8',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => true,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            98 =>
            array (
                'rut' => '98000000-9',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            99 =>
            array (
                'rut' => '99000001-0',
                'business_name' => $faker->company,
                'alias_name' => $faker->name,
                'commercial_business' => $faker->realText(60),
                'g_commune_id' => '15',
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
            100 =>
            array (
                'rut' => '96806980-2',
                'business_name' => 'ENTEL PCS TELECOMUNICACIONES S.A.',
                'alias_name' => 'ENTEL PCS S.A.',
                'commercial_business' => 'GIRO DE ENTEL',
                'g_commune_id' => 26,
                'flag_delete' => false,
                'address' => $faker->address,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'is_company' => true
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('sl_customer')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
