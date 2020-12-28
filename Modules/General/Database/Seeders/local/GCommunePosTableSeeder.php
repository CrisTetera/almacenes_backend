<?php

namespace Modules\General\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GCommunePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('g_commune_pos')->delete();
        
        \DB::table('g_commune_pos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Iquique',
                'g_province_id' => 3,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Alto Hospicio',
                'g_province_id' => 3,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pozo Almonte',
                'g_province_id' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Camiña',
                'g_province_id' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Colchane',
                'g_province_id' => 4,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Huara',
                'g_province_id' => 4,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Pica',
                'g_province_id' => 4,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Antofagasta',
                'g_province_id' => 5,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Mejillones',
                'g_province_id' => 5,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Sierra Gorda',
                'g_province_id' => 5,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Taltal',
                'g_province_id' => 5,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Calama',
                'g_province_id' => 6,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Ollagüe',
                'g_province_id' => 6,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'San Pedro de Atacama',
                'g_province_id' => 6,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Tocopilla',
                'g_province_id' => 7,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'María Elena',
                'g_province_id' => 7,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Copiapó',
                'g_province_id' => 8,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Caldera',
                'g_province_id' => 8,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Tierra Amarilla',
                'g_province_id' => 8,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Chañaral',
                'g_province_id' => 9,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Diego de Almagro',
                'g_province_id' => 9,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Vallenar',
                'g_province_id' => 10,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Alto del Carmen',
                'g_province_id' => 10,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Freirina',
                'g_province_id' => 10,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Huasco',
                'g_province_id' => 10,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'La Serena',
                'g_province_id' => 11,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Coquimbo',
                'g_province_id' => 11,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Andacollo',
                'g_province_id' => 11,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'La Higuera',
                'g_province_id' => 11,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Paihuano',
                'g_province_id' => 11,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Vicuña',
                'g_province_id' => 11,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Illapel',
                'g_province_id' => 12,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Canela',
                'g_province_id' => 12,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Los Vilos',
                'g_province_id' => 12,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Salamanca',
                'g_province_id' => 12,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Ovalle',
                'g_province_id' => 13,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Combarbalá',
                'g_province_id' => 13,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Monte Patria',
                'g_province_id' => 13,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Punitaqui',
                'g_province_id' => 13,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Río Hurtado',
                'g_province_id' => 13,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Valparaíso',
                'g_province_id' => 14,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Casablanca',
                'g_province_id' => 14,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Concón',
                'g_province_id' => 14,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Juan Fernández',
                'g_province_id' => 14,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Puchuncaví',
                'g_province_id' => 14,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Quintero',
                'g_province_id' => 14,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Viña del Mar',
                'g_province_id' => 14,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Isla de Pascua',
                'g_province_id' => 15,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Los Andes',
                'g_province_id' => 16,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Calle Larga',
                'g_province_id' => 16,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Rinconada',
                'g_province_id' => 16,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'San Esteban',
                'g_province_id' => 16,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'La Ligua',
                'g_province_id' => 17,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Cabildo',
                'g_province_id' => 17,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Papudo',
                'g_province_id' => 17,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Petorca',
                'g_province_id' => 17,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Zapallar',
                'g_province_id' => 17,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Quillota',
                'g_province_id' => 18,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'La Calera',
                'g_province_id' => 18,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Hijuelas',
                'g_province_id' => 18,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'La Cruz',
                'g_province_id' => 18,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Nogales',
                'g_province_id' => 18,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'San Antonio',
                'g_province_id' => 19,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Algarrobo',
                'g_province_id' => 19,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Cartagena',
                'g_province_id' => 19,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'El Quisco',
                'g_province_id' => 19,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'El Tabo',
                'g_province_id' => 19,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Santo Domingo',
                'g_province_id' => 19,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'San Felipe',
                'g_province_id' => 20,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Catemu',
                'g_province_id' => 20,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Llay Llay',
                'g_province_id' => 20,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Panquehue',
                'g_province_id' => 20,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Putaendo',
                'g_province_id' => 20,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Santa María',
                'g_province_id' => 20,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Quilpué',
                'g_province_id' => 21,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Limache',
                'g_province_id' => 21,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Olmué',
                'g_province_id' => 21,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Villa Alemana',
                'g_province_id' => 21,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Rancagua',
                'g_province_id' => 22,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Codegua',
                'g_province_id' => 22,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Coinco',
                'g_province_id' => 22,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Coltauco',
                'g_province_id' => 22,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Doñihue',
                'g_province_id' => 22,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Graneros',
                'g_province_id' => 22,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Las Cabras',
                'g_province_id' => 22,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Machalí',
                'g_province_id' => 22,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Malloa',
                'g_province_id' => 22,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Mostazal',
                'g_province_id' => 22,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Olivar',
                'g_province_id' => 22,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Peumo',
                'g_province_id' => 22,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Pichidegua',
                'g_province_id' => 22,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Quinta de Tilcoco',
                'g_province_id' => 22,
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Rengo',
                'g_province_id' => 22,
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Requínoa',
                'g_province_id' => 22,
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'San Vicente',
                'g_province_id' => 22,
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Pichilemu',
                'g_province_id' => 23,
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'La Estrella',
                'g_province_id' => 23,
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Litueche',
                'g_province_id' => 23,
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Marchihue',
                'g_province_id' => 23,
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Navidad',
                'g_province_id' => 23,
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Paredones',
                'g_province_id' => 23,
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'San Fernando',
                'g_province_id' => 24,
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Chépica',
                'g_province_id' => 24,
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Chimbarongo',
                'g_province_id' => 24,
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Lolol',
                'g_province_id' => 24,
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Nancagua',
                'g_province_id' => 24,
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Palmilla',
                'g_province_id' => 24,
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Peralillo',
                'g_province_id' => 24,
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Placilla',
                'g_province_id' => 24,
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'Pumanque',
                'g_province_id' => 24,
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'Santa Cruz',
                'g_province_id' => 24,
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'Talca',
                'g_province_id' => 25,
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Constitución',
                'g_province_id' => 25,
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Curepto',
                'g_province_id' => 25,
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Empedrado',
                'g_province_id' => 25,
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'Maule',
                'g_province_id' => 25,
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Pelarco',
                'g_province_id' => 25,
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Pencahue',
                'g_province_id' => 25,
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Río Claro',
                'g_province_id' => 25,
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'San Clemente',
                'g_province_id' => 25,
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'San Rafael',
                'g_province_id' => 25,
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'Cauquenes',
                'g_province_id' => 26,
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'Chanco',
                'g_province_id' => 26,
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'Pelluhue',
                'g_province_id' => 26,
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'Curicó',
                'g_province_id' => 27,
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'Hualañé',
                'g_province_id' => 27,
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'Licantén',
                'g_province_id' => 27,
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'Molina',
                'g_province_id' => 27,
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'Rauco',
                'g_province_id' => 27,
            ),
            129 => 
            array (
                'id' => 130,
                'name' => 'Romeral',
                'g_province_id' => 27,
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'Sagrada Familia',
                'g_province_id' => 27,
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'Teno',
                'g_province_id' => 27,
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'Vichuquén',
                'g_province_id' => 27,
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'Linares',
                'g_province_id' => 28,
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'Colbún',
                'g_province_id' => 28,
            ),
            135 => 
            array (
                'id' => 136,
                'name' => 'Longaví',
                'g_province_id' => 28,
            ),
            136 => 
            array (
                'id' => 137,
                'name' => 'Parral',
                'g_province_id' => 28,
            ),
            137 => 
            array (
                'id' => 138,
                'name' => 'Retiro',
                'g_province_id' => 28,
            ),
            138 => 
            array (
                'id' => 139,
                'name' => 'San Javier',
                'g_province_id' => 28,
            ),
            139 => 
            array (
                'id' => 140,
                'name' => 'Villa Alegre',
                'g_province_id' => 28,
            ),
            140 => 
            array (
                'id' => 141,
                'name' => 'Yerbas Buenas',
                'g_province_id' => 28,
            ),
            141 => 
            array (
                'id' => 142,
                'name' => 'Concepción',
                'g_province_id' => 29,
            ),
            142 => 
            array (
                'id' => 143,
                'name' => 'Coronel',
                'g_province_id' => 29,
            ),
            143 => 
            array (
                'id' => 144,
                'name' => 'Chiguayante',
                'g_province_id' => 29,
            ),
            144 => 
            array (
                'id' => 145,
                'name' => 'Florida',
                'g_province_id' => 29,
            ),
            145 => 
            array (
                'id' => 146,
                'name' => 'Hualqui',
                'g_province_id' => 29,
            ),
            146 => 
            array (
                'id' => 147,
                'name' => 'Lota',
                'g_province_id' => 29,
            ),
            147 => 
            array (
                'id' => 148,
                'name' => 'Penco',
                'g_province_id' => 29,
            ),
            148 => 
            array (
                'id' => 149,
                'name' => 'San Pedro de la Paz',
                'g_province_id' => 29,
            ),
            149 => 
            array (
                'id' => 150,
                'name' => 'Santa Juana',
                'g_province_id' => 29,
            ),
            150 => 
            array (
                'id' => 151,
                'name' => 'Talcahuano',
                'g_province_id' => 29,
            ),
            151 => 
            array (
                'id' => 152,
                'name' => 'Tomé',
                'g_province_id' => 29,
            ),
            152 => 
            array (
                'id' => 153,
                'name' => 'Hualpén',
                'g_province_id' => 29,
            ),
            153 => 
            array (
                'id' => 154,
                'name' => 'Lebu',
                'g_province_id' => 30,
            ),
            154 => 
            array (
                'id' => 155,
                'name' => 'Arauco',
                'g_province_id' => 30,
            ),
            155 => 
            array (
                'id' => 156,
                'name' => 'Cañete',
                'g_province_id' => 30,
            ),
            156 => 
            array (
                'id' => 157,
                'name' => 'Contulmo',
                'g_province_id' => 30,
            ),
            157 => 
            array (
                'id' => 158,
                'name' => 'Curanilahue',
                'g_province_id' => 30,
            ),
            158 => 
            array (
                'id' => 159,
                'name' => 'Los Álamos',
                'g_province_id' => 30,
            ),
            159 => 
            array (
                'id' => 160,
                'name' => 'Tirúa',
                'g_province_id' => 30,
            ),
            160 => 
            array (
                'id' => 161,
                'name' => 'Los Ángeles',
                'g_province_id' => 31,
            ),
            161 => 
            array (
                'id' => 162,
                'name' => 'Antuco',
                'g_province_id' => 31,
            ),
            162 => 
            array (
                'id' => 163,
                'name' => 'Cabrero',
                'g_province_id' => 31,
            ),
            163 => 
            array (
                'id' => 164,
                'name' => 'Laja',
                'g_province_id' => 31,
            ),
            164 => 
            array (
                'id' => 165,
                'name' => 'Mulchén',
                'g_province_id' => 31,
            ),
            165 => 
            array (
                'id' => 166,
                'name' => 'Nacimiento',
                'g_province_id' => 31,
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'Negrete',
                'g_province_id' => 31,
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'Quilaco',
                'g_province_id' => 31,
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'Quilleco',
                'g_province_id' => 31,
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'San Rosendo',
                'g_province_id' => 31,
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'Santa Bárbara',
                'g_province_id' => 31,
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'Tucapel',
                'g_province_id' => 31,
            ),
            172 => 
            array (
                'id' => 173,
                'name' => 'Yumbel',
                'g_province_id' => 31,
            ),
            173 => 
            array (
                'id' => 174,
                'name' => 'Alto Biobío',
                'g_province_id' => 31,
            ),
            174 => 
            array (
                'id' => 175,
                'name' => 'Chillán',
                'g_province_id' => 32,
            ),
            175 => 
            array (
                'id' => 176,
                'name' => 'Bulnes',
                'g_province_id' => 32,
            ),
            176 => 
            array (
                'id' => 177,
                'name' => 'Cobquecura',
                'g_province_id' => 32,
            ),
            177 => 
            array (
                'id' => 178,
                'name' => 'Coelemu',
                'g_province_id' => 32,
            ),
            178 => 
            array (
                'id' => 179,
                'name' => 'Coihueco',
                'g_province_id' => 32,
            ),
            179 => 
            array (
                'id' => 180,
                'name' => 'Chillán Viejo',
                'g_province_id' => 32,
            ),
            180 => 
            array (
                'id' => 181,
                'name' => 'El Carmen',
                'g_province_id' => 32,
            ),
            181 => 
            array (
                'id' => 182,
                'name' => 'Ninhue',
                'g_province_id' => 32,
            ),
            182 => 
            array (
                'id' => 183,
                'name' => 'Ñiquén',
                'g_province_id' => 32,
            ),
            183 => 
            array (
                'id' => 184,
                'name' => 'Pemuco',
                'g_province_id' => 32,
            ),
            184 => 
            array (
                'id' => 185,
                'name' => 'Pinto',
                'g_province_id' => 32,
            ),
            185 => 
            array (
                'id' => 186,
                'name' => 'Portezuelo',
                'g_province_id' => 32,
            ),
            186 => 
            array (
                'id' => 187,
                'name' => 'Quillón',
                'g_province_id' => 32,
            ),
            187 => 
            array (
                'id' => 188,
                'name' => 'Quirihue',
                'g_province_id' => 32,
            ),
            188 => 
            array (
                'id' => 189,
                'name' => 'Ránquil',
                'g_province_id' => 32,
            ),
            189 => 
            array (
                'id' => 190,
                'name' => 'San Carlos',
                'g_province_id' => 32,
            ),
            190 => 
            array (
                'id' => 191,
                'name' => 'San Fabián',
                'g_province_id' => 32,
            ),
            191 => 
            array (
                'id' => 192,
                'name' => 'San Ignacio',
                'g_province_id' => 32,
            ),
            192 => 
            array (
                'id' => 193,
                'name' => 'San Nicolás',
                'g_province_id' => 32,
            ),
            193 => 
            array (
                'id' => 194,
                'name' => 'Treguaco',
                'g_province_id' => 32,
            ),
            194 => 
            array (
                'id' => 195,
                'name' => 'Yungay',
                'g_province_id' => 32,
            ),
            195 => 
            array (
                'id' => 196,
                'name' => 'Temuco',
                'g_province_id' => 33,
            ),
            196 => 
            array (
                'id' => 197,
                'name' => 'Carahue',
                'g_province_id' => 33,
            ),
            197 => 
            array (
                'id' => 198,
                'name' => 'Cunco',
                'g_province_id' => 33,
            ),
            198 => 
            array (
                'id' => 199,
                'name' => 'Curarrehue',
                'g_province_id' => 33,
            ),
            199 => 
            array (
                'id' => 200,
                'name' => 'Freire',
                'g_province_id' => 33,
            ),
            200 => 
            array (
                'id' => 201,
                'name' => 'Galvarino',
                'g_province_id' => 33,
            ),
            201 => 
            array (
                'id' => 202,
                'name' => 'Gorbea',
                'g_province_id' => 33,
            ),
            202 => 
            array (
                'id' => 203,
                'name' => 'Lautaro',
                'g_province_id' => 33,
            ),
            203 => 
            array (
                'id' => 204,
                'name' => 'Loncoche',
                'g_province_id' => 33,
            ),
            204 => 
            array (
                'id' => 205,
                'name' => 'Melipeuco',
                'g_province_id' => 33,
            ),
            205 => 
            array (
                'id' => 206,
                'name' => 'Nueva Imperial',
                'g_province_id' => 33,
            ),
            206 => 
            array (
                'id' => 207,
                'name' => 'Padre las Casas',
                'g_province_id' => 33,
            ),
            207 => 
            array (
                'id' => 208,
                'name' => 'Perquenco',
                'g_province_id' => 33,
            ),
            208 => 
            array (
                'id' => 209,
                'name' => 'Pitrufquén',
                'g_province_id' => 33,
            ),
            209 => 
            array (
                'id' => 210,
                'name' => 'Pucón',
                'g_province_id' => 33,
            ),
            210 => 
            array (
                'id' => 211,
                'name' => 'Saavedra',
                'g_province_id' => 33,
            ),
            211 => 
            array (
                'id' => 212,
                'name' => 'Teodoro Schmidt',
                'g_province_id' => 33,
            ),
            212 => 
            array (
                'id' => 213,
                'name' => 'Toltén',
                'g_province_id' => 33,
            ),
            213 => 
            array (
                'id' => 214,
                'name' => 'Vilcún',
                'g_province_id' => 33,
            ),
            214 => 
            array (
                'id' => 215,
                'name' => 'Villarrica',
                'g_province_id' => 33,
            ),
            215 => 
            array (
                'id' => 216,
                'name' => 'Cholchol',
                'g_province_id' => 33,
            ),
            216 => 
            array (
                'id' => 217,
                'name' => 'Angol',
                'g_province_id' => 34,
            ),
            217 => 
            array (
                'id' => 218,
                'name' => 'Collipulli',
                'g_province_id' => 34,
            ),
            218 => 
            array (
                'id' => 219,
                'name' => 'Curacautín',
                'g_province_id' => 34,
            ),
            219 => 
            array (
                'id' => 220,
                'name' => 'Ercilla',
                'g_province_id' => 34,
            ),
            220 => 
            array (
                'id' => 221,
                'name' => 'Lonquimay',
                'g_province_id' => 34,
            ),
            221 => 
            array (
                'id' => 222,
                'name' => 'Los Sauces',
                'g_province_id' => 34,
            ),
            222 => 
            array (
                'id' => 223,
                'name' => 'Lumaco',
                'g_province_id' => 34,
            ),
            223 => 
            array (
                'id' => 224,
                'name' => 'Purén',
                'g_province_id' => 34,
            ),
            224 => 
            array (
                'id' => 225,
                'name' => 'Renaico',
                'g_province_id' => 34,
            ),
            225 => 
            array (
                'id' => 226,
                'name' => 'Traiguén',
                'g_province_id' => 34,
            ),
            226 => 
            array (
                'id' => 227,
                'name' => 'Victoria',
                'g_province_id' => 34,
            ),
            227 => 
            array (
                'id' => 228,
                'name' => 'Puerto Montt',
                'g_province_id' => 37,
            ),
            228 => 
            array (
                'id' => 229,
                'name' => 'Calbuco',
                'g_province_id' => 37,
            ),
            229 => 
            array (
                'id' => 230,
                'name' => 'Cochamó',
                'g_province_id' => 37,
            ),
            230 => 
            array (
                'id' => 231,
                'name' => 'Fresia',
                'g_province_id' => 37,
            ),
            231 => 
            array (
                'id' => 232,
                'name' => 'Frutillar',
                'g_province_id' => 37,
            ),
            232 => 
            array (
                'id' => 233,
                'name' => 'Los Muermos',
                'g_province_id' => 37,
            ),
            233 => 
            array (
                'id' => 234,
                'name' => 'Llanquihue',
                'g_province_id' => 37,
            ),
            234 => 
            array (
                'id' => 235,
                'name' => 'Maullín',
                'g_province_id' => 37,
            ),
            235 => 
            array (
                'id' => 236,
                'name' => 'Puerto Varas',
                'g_province_id' => 37,
            ),
            236 => 
            array (
                'id' => 237,
                'name' => 'Castro',
                'g_province_id' => 38,
            ),
            237 => 
            array (
                'id' => 238,
                'name' => 'Ancud',
                'g_province_id' => 38,
            ),
            238 => 
            array (
                'id' => 239,
                'name' => 'Chonchi',
                'g_province_id' => 38,
            ),
            239 => 
            array (
                'id' => 240,
                'name' => 'Curaco de Vélez',
                'g_province_id' => 38,
            ),
            240 => 
            array (
                'id' => 241,
                'name' => 'Dalcahue',
                'g_province_id' => 38,
            ),
            241 => 
            array (
                'id' => 242,
                'name' => 'Puqueldón',
                'g_province_id' => 38,
            ),
            242 => 
            array (
                'id' => 243,
                'name' => 'Queilén',
                'g_province_id' => 38,
            ),
            243 => 
            array (
                'id' => 244,
                'name' => 'Quellón',
                'g_province_id' => 38,
            ),
            244 => 
            array (
                'id' => 245,
                'name' => 'Quemchi',
                'g_province_id' => 38,
            ),
            245 => 
            array (
                'id' => 246,
                'name' => 'Quinchao',
                'g_province_id' => 38,
            ),
            246 => 
            array (
                'id' => 247,
                'name' => 'Osorno',
                'g_province_id' => 39,
            ),
            247 => 
            array (
                'id' => 248,
                'name' => 'Puerto Octay',
                'g_province_id' => 39,
            ),
            248 => 
            array (
                'id' => 249,
                'name' => 'Purranque',
                'g_province_id' => 39,
            ),
            249 => 
            array (
                'id' => 250,
                'name' => 'Puyehue',
                'g_province_id' => 39,
            ),
            250 => 
            array (
                'id' => 251,
                'name' => 'Río Negro',
                'g_province_id' => 39,
            ),
            251 => 
            array (
                'id' => 252,
                'name' => 'San Juan de la Costa',
                'g_province_id' => 39,
            ),
            252 => 
            array (
                'id' => 253,
                'name' => 'San Pablo',
                'g_province_id' => 39,
            ),
            253 => 
            array (
                'id' => 254,
                'name' => 'Chaitén',
                'g_province_id' => 40,
            ),
            254 => 
            array (
                'id' => 255,
                'name' => 'Futaleufú',
                'g_province_id' => 40,
            ),
            255 => 
            array (
                'id' => 256,
                'name' => 'Hualaihué',
                'g_province_id' => 40,
            ),
            256 => 
            array (
                'id' => 257,
                'name' => 'Palena',
                'g_province_id' => 40,
            ),
            257 => 
            array (
                'id' => 258,
                'name' => 'Coyhaique',
                'g_province_id' => 41,
            ),
            258 => 
            array (
                'id' => 259,
                'name' => 'Lago Verde',
                'g_province_id' => 41,
            ),
            259 => 
            array (
                'id' => 260,
                'name' => 'Aysén',
                'g_province_id' => 42,
            ),
            260 => 
            array (
                'id' => 261,
                'name' => 'Cisnes',
                'g_province_id' => 42,
            ),
            261 => 
            array (
                'id' => 262,
                'name' => 'Guaitecas',
                'g_province_id' => 42,
            ),
            262 => 
            array (
                'id' => 263,
                'name' => 'Cochrane',
                'g_province_id' => 43,
            ),
            263 => 
            array (
                'id' => 264,
                'name' => 'O\'Higgins',
                'g_province_id' => 43,
            ),
            264 => 
            array (
                'id' => 265,
                'name' => 'Tortel',
                'g_province_id' => 43,
            ),
            265 => 
            array (
                'id' => 266,
                'name' => 'Chile Chico',
                'g_province_id' => 44,
            ),
            266 => 
            array (
                'id' => 267,
                'name' => 'Río Ibáñez',
                'g_province_id' => 44,
            ),
            267 => 
            array (
                'id' => 268,
                'name' => 'Punta Arenas',
                'g_province_id' => 45,
            ),
            268 => 
            array (
                'id' => 269,
                'name' => 'Laguna Blanca',
                'g_province_id' => 45,
            ),
            269 => 
            array (
                'id' => 270,
                'name' => 'Río Verde',
                'g_province_id' => 45,
            ),
            270 => 
            array (
                'id' => 271,
                'name' => 'San Gregorio',
                'g_province_id' => 45,
            ),
            271 => 
            array (
                'id' => 272,
                'name' => 'Cabo de Hornos',
                'g_province_id' => 46,
            ),
            272 => 
            array (
                'id' => 273,
                'name' => 'Antártica',
                'g_province_id' => 46,
            ),
            273 => 
            array (
                'id' => 274,
                'name' => 'Porvenir',
                'g_province_id' => 47,
            ),
            274 => 
            array (
                'id' => 275,
                'name' => 'Primavera',
                'g_province_id' => 47,
            ),
            275 => 
            array (
                'id' => 276,
                'name' => 'Timaukel',
                'g_province_id' => 47,
            ),
            276 => 
            array (
                'id' => 277,
                'name' => 'Natales',
                'g_province_id' => 48,
            ),
            277 => 
            array (
                'id' => 278,
                'name' => 'Torres del Paine',
                'g_province_id' => 48,
            ),
            278 => 
            array (
                'id' => 279,
                'name' => 'Santiago',
                'g_province_id' => 49,
            ),
            279 => 
            array (
                'id' => 280,
                'name' => 'Cerrillos',
                'g_province_id' => 49,
            ),
            280 => 
            array (
                'id' => 281,
                'name' => 'Cerro Navia',
                'g_province_id' => 49,
            ),
            281 => 
            array (
                'id' => 282,
                'name' => 'Conchalí',
                'g_province_id' => 49,
            ),
            282 => 
            array (
                'id' => 283,
                'name' => 'El Bosque',
                'g_province_id' => 49,
            ),
            283 => 
            array (
                'id' => 284,
                'name' => 'Estación Central',
                'g_province_id' => 49,
            ),
            284 => 
            array (
                'id' => 285,
                'name' => 'Huechuraba',
                'g_province_id' => 49,
            ),
            285 => 
            array (
                'id' => 286,
                'name' => 'Independencia',
                'g_province_id' => 49,
            ),
            286 => 
            array (
                'id' => 287,
                'name' => 'La Cisterna',
                'g_province_id' => 49,
            ),
            287 => 
            array (
                'id' => 288,
                'name' => 'La Florida',
                'g_province_id' => 49,
            ),
            288 => 
            array (
                'id' => 289,
                'name' => 'La Granja',
                'g_province_id' => 49,
            ),
            289 => 
            array (
                'id' => 290,
                'name' => 'La Pintana',
                'g_province_id' => 49,
            ),
            290 => 
            array (
                'id' => 291,
                'name' => 'La Reina',
                'g_province_id' => 49,
            ),
            291 => 
            array (
                'id' => 292,
                'name' => 'Las Condes',
                'g_province_id' => 49,
            ),
            292 => 
            array (
                'id' => 293,
                'name' => 'Lo Barnechea',
                'g_province_id' => 49,
            ),
            293 => 
            array (
                'id' => 294,
                'name' => 'Lo Espejo',
                'g_province_id' => 49,
            ),
            294 => 
            array (
                'id' => 295,
                'name' => 'Lo Prado',
                'g_province_id' => 49,
            ),
            295 => 
            array (
                'id' => 296,
                'name' => 'Macul',
                'g_province_id' => 49,
            ),
            296 => 
            array (
                'id' => 297,
                'name' => 'Maipú',
                'g_province_id' => 49,
            ),
            297 => 
            array (
                'id' => 298,
                'name' => 'Ñuñoa',
                'g_province_id' => 49,
            ),
            298 => 
            array (
                'id' => 299,
                'name' => 'Pedro Aguirre Cerda',
                'g_province_id' => 49,
            ),
            299 => 
            array (
                'id' => 300,
                'name' => 'Peñalolén',
                'g_province_id' => 49,
            ),
            300 => 
            array (
                'id' => 301,
                'name' => 'Providencia',
                'g_province_id' => 49,
            ),
            301 => 
            array (
                'id' => 302,
                'name' => 'Pudahuel',
                'g_province_id' => 49,
            ),
            302 => 
            array (
                'id' => 303,
                'name' => 'Quilicura',
                'g_province_id' => 49,
            ),
            303 => 
            array (
                'id' => 304,
                'name' => 'Quinta Normal',
                'g_province_id' => 49,
            ),
            304 => 
            array (
                'id' => 305,
                'name' => 'Recoleta',
                'g_province_id' => 49,
            ),
            305 => 
            array (
                'id' => 306,
                'name' => 'Renca',
                'g_province_id' => 49,
            ),
            306 => 
            array (
                'id' => 307,
                'name' => 'San Joaquín',
                'g_province_id' => 49,
            ),
            307 => 
            array (
                'id' => 308,
                'name' => 'San Miguel',
                'g_province_id' => 49,
            ),
            308 => 
            array (
                'id' => 309,
                'name' => 'San Ramón',
                'g_province_id' => 49,
            ),
            309 => 
            array (
                'id' => 310,
                'name' => 'Vitacura',
                'g_province_id' => 49,
            ),
            310 => 
            array (
                'id' => 311,
                'name' => 'Puente Alto',
                'g_province_id' => 50,
            ),
            311 => 
            array (
                'id' => 312,
                'name' => 'Pirque',
                'g_province_id' => 50,
            ),
            312 => 
            array (
                'id' => 313,
                'name' => 'San José de Maipo',
                'g_province_id' => 50,
            ),
            313 => 
            array (
                'id' => 314,
                'name' => 'Colina',
                'g_province_id' => 51,
            ),
            314 => 
            array (
                'id' => 315,
                'name' => 'Lampa',
                'g_province_id' => 51,
            ),
            315 => 
            array (
                'id' => 316,
                'name' => 'Tiltil',
                'g_province_id' => 51,
            ),
            316 => 
            array (
                'id' => 317,
                'name' => 'San Bernardo',
                'g_province_id' => 52,
            ),
            317 => 
            array (
                'id' => 318,
                'name' => 'Buin',
                'g_province_id' => 52,
            ),
            318 => 
            array (
                'id' => 319,
                'name' => 'Calera de Tango',
                'g_province_id' => 52,
            ),
            319 => 
            array (
                'id' => 320,
                'name' => 'Paine',
                'g_province_id' => 52,
            ),
            320 => 
            array (
                'id' => 321,
                'name' => 'Melipilla',
                'g_province_id' => 53,
            ),
            321 => 
            array (
                'id' => 322,
                'name' => 'Alhué',
                'g_province_id' => 53,
            ),
            322 => 
            array (
                'id' => 323,
                'name' => 'Curacaví',
                'g_province_id' => 53,
            ),
            323 => 
            array (
                'id' => 324,
                'name' => 'María Pinto',
                'g_province_id' => 53,
            ),
            324 => 
            array (
                'id' => 325,
                'name' => 'San Pedro',
                'g_province_id' => 53,
            ),
            325 => 
            array (
                'id' => 326,
                'name' => 'Talagante',
                'g_province_id' => 54,
            ),
            326 => 
            array (
                'id' => 327,
                'name' => 'El Monte',
                'g_province_id' => 54,
            ),
            327 => 
            array (
                'id' => 328,
                'name' => 'Isla de Maipo',
                'g_province_id' => 54,
            ),
            328 => 
            array (
                'id' => 329,
                'name' => 'Padre Hurtado',
                'g_province_id' => 54,
            ),
            329 => 
            array (
                'id' => 330,
                'name' => 'Peñaflor',
                'g_province_id' => 54,
            ),
            330 => 
            array (
                'id' => 331,
                'name' => 'Valdivia',
                'g_province_id' => 35,
            ),
            331 => 
            array (
                'id' => 332,
                'name' => 'Corral',
                'g_province_id' => 35,
            ),
            332 => 
            array (
                'id' => 333,
                'name' => 'Lanco',
                'g_province_id' => 35,
            ),
            333 => 
            array (
                'id' => 334,
                'name' => 'Los Lagos',
                'g_province_id' => 35,
            ),
            334 => 
            array (
                'id' => 335,
                'name' => 'Máfil',
                'g_province_id' => 35,
            ),
            335 => 
            array (
                'id' => 336,
                'name' => 'Mariquina',
                'g_province_id' => 35,
            ),
            336 => 
            array (
                'id' => 337,
                'name' => 'Paillaco',
                'g_province_id' => 35,
            ),
            337 => 
            array (
                'id' => 338,
                'name' => 'Panguipulli',
                'g_province_id' => 35,
            ),
            338 => 
            array (
                'id' => 339,
                'name' => 'La Unión',
                'g_province_id' => 36,
            ),
            339 => 
            array (
                'id' => 340,
                'name' => 'Futrono',
                'g_province_id' => 36,
            ),
            340 => 
            array (
                'id' => 341,
                'name' => 'Lago Ranco',
                'g_province_id' => 36,
            ),
            341 => 
            array (
                'id' => 342,
                'name' => 'Río Bueno',
                'g_province_id' => 36,
            ),
            342 => 
            array (
                'id' => 343,
                'name' => 'Arica',
                'g_province_id' => 1,
            ),
            343 => 
            array (
                'id' => 344,
                'name' => 'Camarones',
                'g_province_id' => 1,
            ),
            344 => 
            array (
                'id' => 345,
                'name' => 'Putre',
                'g_province_id' => 2,
            ),
            345 => 
            array (
                'id' => 346,
                'name' => 'General Lagos',
                'g_province_id' => 2,
            ),
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('g_commune')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
