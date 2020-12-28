<?php

namespace Modules\HR\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class HrEmployeePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('hr_employee_pos')->delete();

        \DB::table('hr_employee_pos')->insert(array (
            // Los tres primeros están autorizados para hacer apertura, egreso e ingreso.
            0 =>
            array (
                'rut' => '18702940-6',
                'first_names' => 'Rubén',
                'last_name1' => 'Álvarez',
                'last_name2' => 'Rodríguez',
                'email' => 'ruben@yopmail.com',
                'flag_delete' => false
            ),
            1 =>
            array (
                'rut' => '18567591-2',
                'first_names' => 'Rosita',
                'last_name1' => 'Hormann',
                'last_name2' => 'Lobos',
                'email' => 'rosita@yopmail.com',
                'flag_delete' => false
            ),
            2 =>
            array (
                'rut' => '17637485-3',
                'first_names' => 'Alejandro',
                'last_name1' => 'Bonilla',
                'last_name2' => '',
                'email' => 'jano@yopmail.com',
                'flag_delete' => false
            ),
            3 =>
            array (
                'rut' => '17999235-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic1@yopmail.com',
                'flag_delete' => false
            ),
            4 =>
            array (
                'rut' => '17998980-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic2@yopmail.com',
                'flag_delete' => false
            ),
            5 =>
            array (
                'rut' => '17998725-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic3@yopmail.com',
                'flag_delete' => false
            ),
            6 =>
            array (
                'rut' => '17998470-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic4@yopmail.com',
                'flag_delete' => false
            ),
            7 =>
            array (
                'rut' => '17998215-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic5@yopmail.com',
                'flag_delete' => false
            ),
            8 =>
            array (
                'rut' => '17997960-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic6@yopmail.com',
                'flag_delete' => false
            ),
            9 =>
            array (
                'rut' => '17997705-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic7@yopmail.com',
                'flag_delete' => false
            ),
            10 =>
            array (
                'rut' => '17997450-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic8@yopmail.com',
                'flag_delete' => false
            ),
            11 =>
            array (
                'rut' => '17997195-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic9@yopmail.com',
                'flag_delete' => false
            ),
            12 =>
            array (
                'rut' => '17996940-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic10@yopmail.com',
                'flag_delete' => false
            ),
            13 =>
            array (
                'rut' => '17996685-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic11@yopmail.com',
                'flag_delete' => false
            ),
            14 =>
            array (
                'rut' => '17996430-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic12@yopmail.com',
                'flag_delete' => false
            ),
            15 =>
            array (
                'rut' => '17996175-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic13@yopmail.com',
                'flag_delete' => false
            ),
            16 =>
            array (
                'rut' => '17995920-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic14@yopmail.com',
                'flag_delete' => false
            ),
            17 =>
            array (
                'rut' => '17995665-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic15@yopmail.com',
                'flag_delete' => false
            ),
            18 =>
            array (
                'rut' => '17995410-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic16@yopmail.com',
                'flag_delete' => false
            ),
            19 =>
            array (
                'rut' => '17995155-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic17@yopmail.com',
                'flag_delete' => false
            ),
            20 =>
            array (
                'rut' => '17994900-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic18@yopmail.com',
                'flag_delete' => false
            ),
            21 =>
            array (
                'rut' => '17994645-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic19@yopmail.com',
                'flag_delete' => false
            ),
            22 =>
            array (
                'rut' => '17994390-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic20@yopmail.com',
                'flag_delete' => false
            ),
            23 =>
            array (
                'rut' => '17994135-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic21@yopmail.com',
                'flag_delete' => false
            ),
            24 =>
            array (
                'rut' => '17993880-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic22@yopmail.com',
                'flag_delete' => false
            ),
            25 =>
            array (
                'rut' => '17993625-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic23@yopmail.com',
                'flag_delete' => false
            ),
            26 =>
            array (
                'rut' => '17993370-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic24@yopmail.com',
                'flag_delete' => false
            ),
            27 =>
            array (
                'rut' => '17993115-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic25@yopmail.com',
                'flag_delete' => false
            ),
            28 =>
            array (
                'rut' => '17992860-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic26@yopmail.com',
                'flag_delete' => false
            ),
            29 =>
            array (
                'rut' => '17992605-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic27@yopmail.com',
                'flag_delete' => false
            ),
            30 =>
            array (
                'rut' => '17992350-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic28@yopmail.com',
                'flag_delete' => false
            ),
            31 =>
            array (
                'rut' => '17992095-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic29@yopmail.com',
                'flag_delete' => false
            ),
            32 =>
            array (
                'rut' => '17991840-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic30@yopmail.com',
                'flag_delete' => false
            ),
            33 =>
            array (
                'rut' => '17991585-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic31@yopmail.com',
                'flag_delete' => false
            ),
            34 =>
            array (
                'rut' => '17991330-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic32@yopmail.com',
                'flag_delete' => false
            ),
            35 =>
            array (
                'rut' => '17991075-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic33@yopmail.com',
                'flag_delete' => false
            ),
            36 =>
            array (
                'rut' => '17990820-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic34@yopmail.com',
                'flag_delete' => false
            ),
            37 =>
            array (
                'rut' => '17990565-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic35@yopmail.com',
                'flag_delete' => false
            ),
            38 =>
            array (
                'rut' => '17990310-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic36@yopmail.com',
                'flag_delete' => false
            ),
            39 =>
            array (
                'rut' => '17990055-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic37@yopmail.com',
                'flag_delete' => false
            ),
            40 =>
            array (
                'rut' => '17989800-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic38@yopmail.com',
                'flag_delete' => false
            ),
            41 =>
            array (
                'rut' => '17989545-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic39@yopmail.com',
                'flag_delete' => false
            ),
            42 =>
            array (
                'rut' => '17989290-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic40@yopmail.com',
                'flag_delete' => false
            ),
            43 =>
            array (
                'rut' => '17989035-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic41@yopmail.com',
                'flag_delete' => false
            ),
            44 =>
            array (
                'rut' => '17988780-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic42@yopmail.com',
                'flag_delete' => false
            ),
            45 =>
            array (
                'rut' => '17988525-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic43@yopmail.com',
                'flag_delete' => false
            ),
            46 =>
            array (
                'rut' => '17988270-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic44@yopmail.com',
                'flag_delete' => false
            ),
            47 =>
            array (
                'rut' => '17988015-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic45@yopmail.com',
                'flag_delete' => false
            ),
            48 =>
            array (
                'rut' => '17987760-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic46@yopmail.com',
                'flag_delete' => false
            ),
            49 =>
            array (
                'rut' => '17987505-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic47@yopmail.com',
                'flag_delete' => false
            ),
            50 =>
            array (
                'rut' => '17987250-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic48@yopmail.com',
                'flag_delete' => false
            ),
            51 =>
            array (
                'rut' => '17986995-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic49@yopmail.com',
                'flag_delete' => false
            ),
            52 =>
            array (
                'rut' => '17986740-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic50@yopmail.com',
                'flag_delete' => false
            ),
            53 =>
            array (
                'rut' => '17986485-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic51@yopmail.com',
                'flag_delete' => false
            ),
            54 =>
            array (
                'rut' => '17986230-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic52@yopmail.com',
                'flag_delete' => false
            ),
            55 =>
            array (
                'rut' => '17985975-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic53@yopmail.com',
                'flag_delete' => false
            ),
            56 =>
            array (
                'rut' => '17985720-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic54@yopmail.com',
                'flag_delete' => false
            ),
            57 =>
            array (
                'rut' => '17985465-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic55@yopmail.com',
                'flag_delete' => false
            ),
            58 =>
            array (
                'rut' => '17985210-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic56@yopmail.com',
                'flag_delete' => false
            ),
            59 =>
            array (
                'rut' => '17984955-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic57@yopmail.com',
                'flag_delete' => false
            ),
            60 =>
            array (
                'rut' => '17984700-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic58@yopmail.com',
                'flag_delete' => false
            ),
            61 =>
            array (
                'rut' => '17984445-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic59@yopmail.com',
                'flag_delete' => false
            ),
            62 =>
            array (
                'rut' => '17984190-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic60@yopmail.com',
                'flag_delete' => false
            ),
            63 =>
            array (
                'rut' => '17983935-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic61@yopmail.com',
                'flag_delete' => false
            ),
            64 =>
            array (
                'rut' => '17983680-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic62@yopmail.com',
                'flag_delete' => false
            ),
            65 =>
            array (
                'rut' => '17983425-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic63@yopmail.com',
                'flag_delete' => false
            ),
            66 =>
            array (
                'rut' => '17983170-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic64@yopmail.com',
                'flag_delete' => false
            ),
            67 =>
            array (
                'rut' => '17982915-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic65@yopmail.com',
                'flag_delete' => false
            ),
            68 =>
            array (
                'rut' => '17982660-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic66@yopmail.com',
                'flag_delete' => false
            ),
            69 =>
            array (
                'rut' => '17982405-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic67@yopmail.com',
                'flag_delete' => false
            ),
            70 =>
            array (
                'rut' => '17982150-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic68@yopmail.com',
                'flag_delete' => false
            ),
            71 =>
            array (
                'rut' => '17981895-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic69@yopmail.com',
                'flag_delete' => false
            ),
            72 =>
            array (
                'rut' => '17981640-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic70@yopmail.com',
                'flag_delete' => false
            ),
            73 =>
            array (
                'rut' => '17981385-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic71@yopmail.com',
                'flag_delete' => false
            ),
            74 =>
            array (
                'rut' => '17981130-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic72@yopmail.com',
                'flag_delete' => false
            ),
            75 =>
            array (
                'rut' => '17980875-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic73@yopmail.com',
                'flag_delete' => false
            ),
            76 =>
            array (
                'rut' => '17980620-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic74@yopmail.com',
                'flag_delete' => false
            ),
            77 =>
            array (
                'rut' => '17980365-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic75@yopmail.com',
                'flag_delete' => false
            ),
            78 =>
            array (
                'rut' => '17980110-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic76@yopmail.com',
                'flag_delete' => false
            ),
            79 =>
            array (
                'rut' => '17979855-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic77@yopmail.com',
                'flag_delete' => false
            ),
            80 =>
            array (
                'rut' => '17979600-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic78@yopmail.com',
                'flag_delete' => false
            ),
            81 =>
            array (
                'rut' => '17979345-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic79@yopmail.com',
                'flag_delete' => false
            ),
            82 =>
            array (
                'rut' => '17979090-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic80@yopmail.com',
                'flag_delete' => false
            ),
            83 =>
            array (
                'rut' => '17978835-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic81@yopmail.com',
                'flag_delete' => false
            ),
            84 =>
            array (
                'rut' => '17978580-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic82@yopmail.com',
                'flag_delete' => false
            ),
            85 =>
            array (
                'rut' => '17978325-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic83@yopmail.com',
                'flag_delete' => false
            ),
            86 =>
            array (
                'rut' => '17978070-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic84@yopmail.com',
                'flag_delete' => false
            ),
            87 =>
            array (
                'rut' => '17977815-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic85@yopmail.com',
                'flag_delete' => false
            ),
            88 =>
            array (
                'rut' => '17977560-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic86@yopmail.com',
                'flag_delete' => false
            ),
            89 =>
            array (
                'rut' => '17977305-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic87@yopmail.com',
                'flag_delete' => false
            ),
            90 =>
            array (
                'rut' => '17977050-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic88@yopmail.com',
                'flag_delete' => false
            ),
            91 =>
            array (
                'rut' => '17976795-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic89@yopmail.com',
                'flag_delete' => false
            ),
            92 =>
            array (
                'rut' => '17976540-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic90@yopmail.com',
                'flag_delete' => false
            ),
            93 =>
            array (
                'rut' => '17976285-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic91@yopmail.com',
                'flag_delete' => false
            ),
            94 =>
            array (
                'rut' => '17976030-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic92@yopmail.com',
                'flag_delete' => false
            ),
            95 =>
            array (
                'rut' => '17975775-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic93@yopmail.com',
                'flag_delete' => false
            ),
            96 =>
            array (
                'rut' => '17975520-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic94@yopmail.com',
                'flag_delete' => false
            ),
            97 =>
            array (
                'rut' => '17975265-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic95@yopmail.com',
                'flag_delete' => false
            ),
            98 =>
            array (
                'rut' => '17975010-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic96@yopmail.com',
                'flag_delete' => false
            ),
            99 =>
            array (
                'rut' => '17974755-0',
                'first_names' => $faker->firstName,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'email' => 'agroplastic97@yopmail.com',
                'flag_delete' => false
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('hr_employee')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
