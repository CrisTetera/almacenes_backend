<?php

namespace Modules\General\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuditSendedEmailLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('audit_sended_email_logs')->delete();
        
        \DB::table('audit_sended_email_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'g_user_id' => 1,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'aX6rid9QJiyfFGDZpX9KrnAJHAAKUdndEXhdBM538sqeehFJP5axzmq3pjzO9ToS3gvqtGCLz1PJJUnvw86CwG1R4B7StHXOjqGl',
            ),
            1 => 
            array (
                'id' => 2,
                'g_user_id' => 2,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'KkDf1fP3KKVY2gvhQysOsPpRcr5vXTu4DNmyZqcHMSM2vj7Y0nYseZpFjUM17DmqMs4vgGl7HP9ER90IVJpzqXTK9Kmh0sZcMFRO',
            ),
            2 => 
            array (
                'id' => 3,
                'g_user_id' => 3,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'T68c48W28w5p5Wx1PIIdD4miNOmrig4v6KWIj40bm9XneHTJSc066ZYe42zskUW44ichL4vhH1XwUJl541c9voQfFXSAXPXpZOxh',
            ),
            3 => 
            array (
                'id' => 4,
                'g_user_id' => 4,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'Noyhu7PWYgW6UqkKDqLuwfnxRLfyiarDOplsy8fZunhOq3D9P2h2xaMAJCxjUtO3NKEAdbpPVFmrj7HKtM6FAhHiyLK4k5KehLgV',
            ),
            4 => 
            array (
                'id' => 5,
                'g_user_id' => 5,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'ejZxLfs0B1pqZBV7pgXASx1BIX3g21oUUKNQMfaEEuinzbzELiKV9H9x5j09sZ67QymUSOUiNHaSlV2WlYll3Kx4Rqd0IDok84tT',
            ),
            5 => 
            array (
                'id' => 6,
                'g_user_id' => 6,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'blyJ7opvey5CPWOV2CofvBUHK4HImDKOzFyrjkVWe7nC3Qz3SjAlTIXrevX4svC55nfQ4XuOS5Els7D0qYn8zA6NwGgImjT7XaVO',
            ),
            6 => 
            array (
                'id' => 7,
                'g_user_id' => 7,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'IcjHpv5Pmdkudmv0yOpQ8kpdpAHk244qdXuo6KhZdgmV10iCaD1Mnm2dWG9HzpqBJscKHCS6edkPlk4A1Fec9Wh8gyHoA3kHSUzs',
            ),
            7 => 
            array (
                'id' => 8,
                'g_user_id' => 8,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'fRG8BTThICQro8zn8VrZKFUblvraZyrlwbjMhzTAGQG77Pi2tJ7dSoa1vcqqJSHEmhUplhQ7rvx1V8TIXAwLFU9VMZ0jZtf7KG0O',
            ),
            8 => 
            array (
                'id' => 9,
                'g_user_id' => 9,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'XoQJ4q8tNYaHavJZXjcbeMe4Kduj1t1No98Z843511LCkHiBDIC8W2mluZ73khy8Pja6MysTe9iATugjcNo9oqxgAkRfaFRHhF1U',
            ),
            9 => 
            array (
                'id' => 10,
                'g_user_id' => 10,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'CIAcQpAMQ2uXmfbnajOcjY0pAYCWCn39Vb7DUqHmyuBxctkD9POCmM6ckSBmiPWCalVbKVKEt0xXJMmdLymArSu9fzBaw9JArSGv',
            ),
            10 => 
            array (
                'id' => 11,
                'g_user_id' => 11,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'e7SbOaEh8ndsoiKM6q5h8qkCT0wUj2U9EvuZi3d6diqT1eTewyOlvVQez88eC7nphWogXqOMVXym9hnq5BsDT4owlKvSwisDDy5b',
            ),
            11 => 
            array (
                'id' => 12,
                'g_user_id' => 12,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'ueMAWkqZSDn9DjOop9xLXempvZEwvjm8EiUPYEobG5sCf09SntfrhB7Og3JO01zyJIwcumWjI32cQ5shgelwbIHmXlpkNvLknjWL',
            ),
            12 => 
            array (
                'id' => 13,
                'g_user_id' => 13,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'NKaFOqf6kyqz4gaUUaxT28xhJJmVn2OD1xMTkrFn4R28hSKplgKLjxv8dZekSkytkwz0O6zxoE6XTgpYPFYwJqCabRAddHdFdu00',
            ),
            13 => 
            array (
                'id' => 14,
                'g_user_id' => 14,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'ZwGaPp6ZUwnBHv5VYLtTjYQYszU9OiaJl4EQLcH3hHbJCwIEFJJAVPcEBM9tEP28T6G80uUEh2qvtb0yTWapUgMUWCcHLeuXs5bW',
            ),
            14 => 
            array (
                'id' => 15,
                'g_user_id' => 15,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'W7HKFrRFMrdoCxLeLrIRBMT1P8acblZDeUb5T28acpSnlPpEy2HB3wwpOa2FU6wkDuZdbQU2XJN0BlODSMP360QZzA7Kcp9m7VXg',
            ),
            15 => 
            array (
                'id' => 16,
                'g_user_id' => 16,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'uevz2h8AteKBk8GAcrAL6AvStlMT1swZIMfI1Oja9HCSTAqPLE1gteHpJpvI5Wd0nHGYs5HXbJvWH4f5JGEuLqJZiheS5EluJOb1',
            ),
            16 => 
            array (
                'id' => 17,
                'g_user_id' => 17,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '2Z5wAgaLg6UCFTIZh3TpHDYjthR7C7IN3dWy93K1wLmYCllmVti5SneuSF6u9xHTDT0YW7ujLyckiLld0YO4cYwYX1XTpGSFVKqY',
            ),
            17 => 
            array (
                'id' => 18,
                'g_user_id' => 18,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'wv0TjS4cXyxFZ72GgwTmFus49XypV59WaCWXiRzOhsCWdbfwJXiG4SIzTaSeWtEqhNyfI1X4BR0XCTYwVsuVnSUYkxxOdXaLhppr',
            ),
            18 => 
            array (
                'id' => 19,
                'g_user_id' => 19,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'WkVfMUaPbcLMlHcQmmQnNlg8NGlbm4athgSSHUjIWZtEq5hCtnyPG1X2Y8G7Kfjii3dvpmRzt0JhOppUkIJ48239NjheSPJQcbou',
            ),
            19 => 
            array (
                'id' => 20,
                'g_user_id' => 20,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'XyrmZQ4XOkNwF6RMexASGbEftFB1ZUKoGmqhAJZE2wrhDk4PXc0IpmJReW9Aex0aHQ4xktHjFK7qd62mC4DsVLjTn1ftC9920jaQ',
            ),
            20 => 
            array (
                'id' => 21,
                'g_user_id' => 21,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'MYUM2n7vfOD5lmnm1REUd9FpdvhHEPQh4t3RPU4OHbyKzPkvhN8X3kSsXXUWk2TDd9QG4bCLUJRxbxK4mE5PEbtl3NHmlaymQeSd',
            ),
            21 => 
            array (
                'id' => 22,
                'g_user_id' => 22,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'TpnLaGUFYJdgyVYAbTOgZeAas0SkO5djFAKxhC9q7fK8fd1c7c06MjXkY5u24XxTquqXJyxt0pH7xIbqlotSiP6Os8KANU7QM8Nx',
            ),
            22 => 
            array (
                'id' => 23,
                'g_user_id' => 23,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'HK1qLHZzOjRUkUazTNjzcEUAJlivwZxsYoMnwfnp7U0kl0vLMU9U2BkuDJ3iXzAYev5ekJuW3MbN5fqXQVz5aq7a2eBks6wlSNhV',
            ),
            23 => 
            array (
                'id' => 24,
                'g_user_id' => 24,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'gbTAZwU6NUrNVZmsm7jCmmRn471EBS0k4BDl3MpzdsdE76N9E9CEAOj3lhjHfm2ZnR22vHQ6pYOtIOSr6fXtFsOB2PanRJnNOQOJ',
            ),
            24 => 
            array (
                'id' => 25,
                'g_user_id' => 25,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'fpocSVyxWvXvWR89sHn5YdZi48ATOAzCWLoze6KWXFLM0DLjNutL0JsYgINc4vvC0VHWY2P0BKzczMdLjUSeVxELVVNIQh07mF8E',
            ),
            25 => 
            array (
                'id' => 26,
                'g_user_id' => 26,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'KDFPgdFQj5bxfIzwOTECLsSi1wvPoW8JJNTmxoaoELGYW4ucraThfHMItUd8rAQ0uJxxITXD0bINjDpp9x9RQAnNTfCCjV1RB5gq',
            ),
            26 => 
            array (
                'id' => 27,
                'g_user_id' => 27,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'Orpvfyc4gUY0PlcJmIRaDM9OH4ZG8rePFYgR3o9PJKXzX41wgrGQDhT8TzrAbrWxyzWbDqsN3D31XuZvnvphCx0uSkDJsZrLvQXA',
            ),
            27 => 
            array (
                'id' => 28,
                'g_user_id' => 28,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'QfaDQfOzEiZjeRs2GZHtBVbbQ5mt0O9RvngUMUlY3nBGVxBrjjWx0B8QLJNJopz5yqtpKTtlPVBEluodETvNAtuAe3lnMHXSkVDo',
            ),
            28 => 
            array (
                'id' => 29,
                'g_user_id' => 29,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'aEWuG2BxDFa9NRePXOOUAC22Bfdz6DEgi7Vuc7t8sFZD9wHcrnQGrB6XKQOxNCvsilbKMmGdECRgUliEQNw9kK6qoEpYumis7Q7K',
            ),
            29 => 
            array (
                'id' => 30,
                'g_user_id' => 30,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'kGutXkq5WFN4wCWSE6Kwwxeo8EGcZw1GGh33JdTmnHUw1Y6j2RI0eUPInr2UaKiNZcn6mPUXPugYbwE3z75xunBGBCwOFywLdCnM',
            ),
            30 => 
            array (
                'id' => 31,
                'g_user_id' => 31,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'ygKX0BL6WbjLJDSxH7HAyq9NE5MFaDME6RiEqDyopA8s1xAYTUBy0jOdoGEjYhd3CbJ59Q474Uu2CFJ6PWHzmYdbm0ILdhx7hjqR',
            ),
            31 => 
            array (
                'id' => 32,
                'g_user_id' => 32,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'RJ1jHmwj74NdjhloLEeAsQOclqVEA8J11mGPb669pJxw2Y14XNekcTKAl4F0FaXbQxXoPbFgwQqV85dN6o83xrGhA24rKtVnRrR7',
            ),
            32 => 
            array (
                'id' => 33,
                'g_user_id' => 33,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '4KSMa6WFAQSdAWLPwFdcHMejgXGzDkYb231pYsIFYyPlGiWc5KX9tWAkRknGSSgOq6KgJDqaR5GbxZ8AUcTmPlbZjGzMntWNcV5b',
            ),
            33 => 
            array (
                'id' => 34,
                'g_user_id' => 34,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'FNRyzQhqBBY4ZZkcYCCFlmgwmitpt24HNGtXwIWftU2pvmDdkCpeIMjtMj4AHVjLsosJd7p7MBDRcT4RYuGViKTal42G1llEYmgj',
            ),
            34 => 
            array (
                'id' => 35,
                'g_user_id' => 35,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'nTtTKXBSLMccAx8PkMmgusOMHLty8GQmN3I0AGz5D7whGRDUtAZrgU0vC1EGOLvzJRyPOuBHra2fN3uU4qWUx3ngFV6xxqHhohO2',
            ),
            35 => 
            array (
                'id' => 36,
                'g_user_id' => 36,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'kunWfDgHgfjv1Br7bS2WL2523GboWSUs8yeWfWdZBdWUem7D2L7HkWEWuoCqmQGQgjpELOEctxx2X1vRNRnP09yQr3z2ILIvQ7YV',
            ),
            36 => 
            array (
                'id' => 37,
                'g_user_id' => 37,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'PATUxuY7hco3OG9bfVH0odBmaIa3Cl9cQ3HrpqCEkcpHkNXCmjlBj0siMISAomeuS8kiJLP70S4ESK8sIjuAFtTDsilZfcTextLR',
            ),
            37 => 
            array (
                'id' => 38,
                'g_user_id' => 38,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'QYq2LqtlPTSJdch6kbcyr3vG4FYoMG8Ef79A22ZbhsTfQrTjVgbtrgUzeu4uoX6mwcJZgluG6EQiDz0GWY7zw9Z4Gzq5sP8G5U5N',
            ),
            38 => 
            array (
                'id' => 39,
                'g_user_id' => 39,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'LrOzkhaQ1hsxxXeJvZzidKQeCe6ONyyohr1X47Cuo36Xq3bbXsMVVySDyAhbmS7L3CkgSw5d76c0FOIcWCKn8PruOMqSvdJb8s7e',
            ),
            39 => 
            array (
                'id' => 40,
                'g_user_id' => 40,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'LD0E7pqKSjg6KZ6D4ZxfiXKIOCWdIk4fhy28RhveUDaLnNHBfqyeYDc4iALnbsT8vNaRtlExUuPWBzcPjtjA6tEkrea3SuN6Co3b',
            ),
            40 => 
            array (
                'id' => 41,
                'g_user_id' => 41,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'KUWmPreY5Hw5qEDumVBmGSvuRl77uFak6GlfqpsDJP77XaMTXZA2SO23DM4txSlx62KaGcAvkTcVqqvlMiFkwAgQc0Njd7QR755F',
            ),
            41 => 
            array (
                'id' => 42,
                'g_user_id' => 42,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'U2BZlqTC3z4IWKPsUhBdnp0NWUm4xMf8zMftZDJaGgWPizTxKvP2jCMbpcv5We0UcjpdnILrgs1pZJIcTW72JxfZvu882xB7761t',
            ),
            42 => 
            array (
                'id' => 43,
                'g_user_id' => 43,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'BJb4UqUALTEMxAxL2fYVqRjIl6StV6r3Ac9OhF4pYy7iAhUORsARWRvwUwoicBgcqrRQO5r3CvIu9oclwHL38zZxZ2i5LpPhrxO4',
            ),
            43 => 
            array (
                'id' => 44,
                'g_user_id' => 44,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'gWe8eKssVYdokAl3fZSA026kHeARJKqFLXncmOstH0sJSYVaJs1RZYJblPc9nVvG9qZW5wcXkJjhUSa3Slns2gmAr7GIULh99yet',
            ),
            44 => 
            array (
                'id' => 45,
                'g_user_id' => 45,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'cbq8ZgFq4PJafpeNjoM4tz6PepbNyZzHUFJJGex6etJ2HXtarr27OPt9by6sXNlhc3lB7OnkeJyGHn2MYLE0ysc2NcPZyVSsUGc0',
            ),
            45 => 
            array (
                'id' => 46,
                'g_user_id' => 46,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'GqnXnQ7kBk45otBMc5bocJAx7bTDw6Tnd2UJONroyCCSeKY6zbcK3XWKnXAnAKhK7VcoYvJPktq44GYGcB7ID6RRUvgIrJnWIClk',
            ),
            46 => 
            array (
                'id' => 47,
                'g_user_id' => 47,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '5JYPgybGjqtj4SMH5rqmDUKMcgkLTyaaiVK8nvP7SSH6hjMpRkWzmT9PWbPxu9X7uQ50t4zKXeBhHFnitjGPOCnUxFlSIEHsvBio',
            ),
            47 => 
            array (
                'id' => 48,
                'g_user_id' => 48,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'ZErncJncpWwCeUAJGfrc2Cl7Pb0eeB9KwRAaM0pozEyF2aH7EMYNoED9le9SXMcReRtkLqlrGfLWeHY5PYuyNufkS7gcVgNVpq6Z',
            ),
            48 => 
            array (
                'id' => 49,
                'g_user_id' => 49,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'jH40eNjnRvg4h0jo3JHWz9JpJu75b7xRugsC0mUIERGiSHJIBW4Za4iD2t9VSylPmhUA3kIgu0tFWmXLJWQqG0abKClvYHT6rwkg',
            ),
            49 => 
            array (
                'id' => 50,
                'g_user_id' => 50,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'yXScgNDJAOz7XvZpuoDG4N9dhNYqJpHgXeUzTh0qzweIX93gzDqy9m7GRC4H91yW4ofJRmiUqe6muRX4IQTm7IYTL9ZUWcR5utCG',
            ),
            50 => 
            array (
                'id' => 51,
                'g_user_id' => 51,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'PPo0HNjCTQeba4lilQr6uo2DN4paVyelMWeFpHKYUKnswmZJeOiSNejHlHSQsJSopvt6t4J1Dg6bJF3JmJkUFwpnDfcOzXyQYEou',
            ),
            51 => 
            array (
                'id' => 52,
                'g_user_id' => 52,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'jdnR1EU8ooJshbEbDJ6oammyuaLRJw9Mgrhxef9J9T7ffiZVkHEvWh5HBCedMElMwlxKw7yX3jOhbNsT2CU1EvDt226ywLGCFwpC',
            ),
            52 => 
            array (
                'id' => 53,
                'g_user_id' => 53,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'sH6dsMTeS6tkr9nbksFcAWfD5bYsjc8gJcf7iV7plVEipUtyBg5P3sAF2HHFVC0HQpEcarKnWDm43XXBdiR2A5WKqUv3xy3yyHvi',
            ),
            53 => 
            array (
                'id' => 54,
                'g_user_id' => 54,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'F5HYvi56vMT5klad7MeLGNi7miCS13FpwdAHdSwUovDU54LsTmZAYA1x6US7xvCsENufuTkW2bCqV0CV8OY0qkJQkKAIMoAhgWpL',
            ),
            54 => 
            array (
                'id' => 55,
                'g_user_id' => 55,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'UUSSEdOdHIEpTWJFMxyYiDCgdPmC9bxGxujOTFDcePMx4sHHoDkGluv3S99w6uExVFbvs5ozb3E2Tk3ze8tsIS5TeQDj7K6azjVz',
            ),
            55 => 
            array (
                'id' => 56,
                'g_user_id' => 56,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'SB608U1DbatNCNk4vkCMjCwU8N8vjMWIJyPNqXQ1ZGjjU7nKC9qUjSJZj8l1qsiD10M1CnyalXvsAOFiesB6BpYmocpyR2OrzMHX',
            ),
            56 => 
            array (
                'id' => 57,
                'g_user_id' => 57,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'uotf1D4a85eLC6ViUJoZrd6d927fMY9kfXYO4QSRSIXdtHeTsWgfwnZ9rOJmt9altrdDGsuIoAepIirudeGFCFggHJZqvtRUd9UI',
            ),
            57 => 
            array (
                'id' => 58,
                'g_user_id' => 58,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '2OMvgxHbQvCXodDpRo3adK1TVutitUIEc4FkSUXSPSEZhtyNyxdr5m6JnxwK7VgjIJAqPLpINKXZbf0TTCvwt6wxhE2wqkvZtBb4',
            ),
            58 => 
            array (
                'id' => 59,
                'g_user_id' => 59,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'YkEXkBpzvUfyGaYZsYUP1WhzhAM1aBC3sEKNfclvderG1YXO4suzKzVtr05Di7rf8dFctwsaxCGMWUOswBbBktAhYQk5F0udt9hB',
            ),
            59 => 
            array (
                'id' => 60,
                'g_user_id' => 60,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'dC0hI5afHWY9dA1sdrNhaZgAmFpMldDyxPBUopSL8zA5uFJq6h59ZBhEWjoO07vHKydokHcTu2oJFVHRyQAlXvI11wcUVY1o77r8',
            ),
            60 => 
            array (
                'id' => 61,
                'g_user_id' => 61,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'Ur4v6mG8d61fc3xV3149DEp2Fc0l6ZHxa2IcfhVP3i5LShd2zrlzfDFNw1L4xzRXMAitc9bW2cqEswBoqdvxfTUIvPd7bKNBCf1V',
            ),
            61 => 
            array (
                'id' => 62,
                'g_user_id' => 62,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'yxqh9yOOlPClBTESaje3D6rSSHPgiJbO9sgHzo2B5BlzGEwFvKv5wwdQtfK3iMttoR8TGVCyeZKmgnA48iIM0omiUV2etDmBJqV3',
            ),
            62 => 
            array (
                'id' => 63,
                'g_user_id' => 63,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'sY80FcIoDRFMdTyrch2vsbgYBh1LbEB1ovldc5BDXMZ0B6aQhSxPEiy69bwJY805wvdqDUtR2PZPpaH9FPYG6Jl2gYL0nJwjDuZl',
            ),
            63 => 
            array (
                'id' => 64,
                'g_user_id' => 64,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'cdN0Tl8R4JcLJ7gnHUWiWKJxuDAIyY91SWc8Z4rQNsNIw7zPzB4dzS6wrNHb4HV7AdWiS5RPwQGayew9HrUx8d5eKNTVDAkQlddS',
            ),
            64 => 
            array (
                'id' => 65,
                'g_user_id' => 65,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'evW28R76YfBZBsH7efEZH4SHnCoMmMryfxeFlinC0M6Ulsubvz5oZXFfIBwRkES5Wy8kWp1obbvRJWaaoDw8zJ1cKPeLN6sdHlhr',
            ),
            65 => 
            array (
                'id' => 66,
                'g_user_id' => 66,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'rUGmyyrA0u9CIL1Yc4GQlY56yrGoYbLdbBZ2u1sVnebLPvM3H2LBSpWZqYvGiO92D1cR0047k5ZXLrixKyurzGpML1l9gtxzfw0S',
            ),
            66 => 
            array (
                'id' => 67,
                'g_user_id' => 67,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'XGPFXm2FgMDjrcfAoZM66bmugLvg4spFHcWwaalJdkj4J1bMUBGdprVYyb0i60BLKzt9g9f9HB3ZhFBeO7Jxg5K8GwsDuf1EHFBH',
            ),
            67 => 
            array (
                'id' => 68,
                'g_user_id' => 68,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '39YLNZGx5hfEVabmHKQl4TcCX8Z8gSo3Y2geMQhzC6snLtQXP3SOxVlw1bYxMp1UwQImC5rF9WqjtORUeRcN3H1ICYY9Gv4wABW6',
            ),
            68 => 
            array (
                'id' => 69,
                'g_user_id' => 69,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'Cogfs4iK2hnkA4HGaFkvna2SRwLqpyQJLkvO5AcA7bxOg1Z0KFaa2s3XMUqJMIqvYAqz17xKmWONAIXrrV4qw2MjY2zDsiel4976',
            ),
            69 => 
            array (
                'id' => 70,
                'g_user_id' => 70,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'gnIlNLofKaVa8gMgqO4wxHmMXq8yiY4pJ5vX8hIpxm0izfkgX5TSUVrutF5FapafirnfZoDrltlCdM4oKt4IoCWWCj1FqvX6FAx3',
            ),
            70 => 
            array (
                'id' => 71,
                'g_user_id' => 71,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'sXmVWapJ2MKpvAGCZMJujfj8iXrW6IdWti2hoIMfBkXLLJo1gCUZ9BFJYXljV79uRvdl06PtEpPIf5Pl01AEmO1pvGaw1pNpktpC',
            ),
            71 => 
            array (
                'id' => 72,
                'g_user_id' => 72,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'V3bYBTC34Tu2gReXww6jUaXOgwEa2D4gmpKzgnMLkc4YsVULjzYYHR5utsWVfEoj8O1KfrvmVWMeSKjRdHZKvHqxVT33mvF8yYbX',
            ),
            72 => 
            array (
                'id' => 73,
                'g_user_id' => 73,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'nqg0iMh1lvIXNk93qTECwV9TS4B2nXYYiUtP9Ie1b52NKEXovR2ZDXutDFSAYiKx6jFIQSgHq8Y1CC9omdVNEY5mEq3ilrxXyXzt',
            ),
            73 => 
            array (
                'id' => 74,
                'g_user_id' => 74,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'pmSIfAtxbW8kJGNtT2KwHimMIy8kkjbLWZmsMrLI2cGtSgJmwJzloopMov4K5uYOAUiHZnytBHQUvy5kg14oQcMzvqYoRnBvaqo0',
            ),
            74 => 
            array (
                'id' => 75,
                'g_user_id' => 75,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'eblapXjm01HV3dNx1lWcLSGHfkl1GvvDoKhnGaWPOmvlYlHA18LGoKOZEW6hkNZhJmADYNZJrhxxxQlFIlyPssWr0qB63xW7gCqj',
            ),
            75 => 
            array (
                'id' => 76,
                'g_user_id' => 76,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '6TkMiDlJLjiugVa25wIP6Um9NTqfzrBwx1CzAG7DfBq7I9vKDY7OiayMqnS44EHmgfCKdBpwoiiztJcQjPsHV2FyRMxb1E3KyXHL',
            ),
            76 => 
            array (
                'id' => 77,
                'g_user_id' => 77,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'hgMnNyPWmcNTUQQH2Tx9ykUNePSF4yOhoCWT5iC7Jl18h0BECm5mME3G3mVXvQIr9F6ts2zPufa70XumOZ4Rhc54tzYZpIIXoj85',
            ),
            77 => 
            array (
                'id' => 78,
                'g_user_id' => 78,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'p4IhlVDKiFJ7HOS9t6UCpVhnC5hp2EN4iTLfJOfUjl5JktMYh6L8uggLGbQQ9Jq1qRuC25Fb3ihlym753XNBh5VZspierISI4dKJ',
            ),
            78 => 
            array (
                'id' => 79,
                'g_user_id' => 79,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'J54VpwE85SPgoEGmT9iXsw1NzKygWbmApIgdJLEskWwB6uFhcpVoVVuSPe2wXCneZmBGYivSFqCmgOGrqG21Hjc2OaCq2uJyyzXX',
            ),
            79 => 
            array (
                'id' => 80,
                'g_user_id' => 80,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '2v4DnbBnktpmZuvcZk1HNpluanB62LmjOqtEYqmmNbr1lyopAdLyLb2pEJJtTeewfIeFEUWlSGmnMcCycUPD3ZrTCOQD0mpjBNid',
            ),
            80 => 
            array (
                'id' => 81,
                'g_user_id' => 81,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '29dD4U2YpL6jiGsloQJYZi6KtSFNpR7Y0A2GjsAoSovDzG0PW4vDsyg14TQvABVyBLN2mRsjfkxw9r33JHSeNVqmykjZBhCSa7Ft',
            ),
            81 => 
            array (
                'id' => 82,
                'g_user_id' => 82,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'SvP2JtnklWkVRwWEvii8lokRiB5JApmdnPTxT6nvvW5aqtWF4rQY8z5IVl5JMFuBmULxSIl224F2lnn5ErxbvpwYsgFP60ZLju76',
            ),
            82 => 
            array (
                'id' => 83,
                'g_user_id' => 83,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'KhCGGKZ9g3AzGzx8kTTFztfw5MVdTJf3KXDXUFcxs6OKqIL2URUSo9bBs4MxqGQeL8lPFRY1TwzSMeT6qL7xyTjwZBmaXT7mexDv',
            ),
            83 => 
            array (
                'id' => 84,
                'g_user_id' => 84,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'FsI9p8MoIZmzIDtr51AY3Ao6QNypHYzz3tjikquPeYtBWvyXag6zd4LLSdcefOaMy5Tg7g4FTXYmXzr3jSpAhAs4E3xgZdWTXflX',
            ),
            84 => 
            array (
                'id' => 85,
                'g_user_id' => 85,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'Iz5vV7wf7rL9B0TaWs2qlk02feVy99AtP1RtiQD5GPv3NOvIOI2WtlXPTxJ42cJm0xjoFKz8XOdZGPzCiNSOdt8vXrTuCnXUbWav',
            ),
            85 => 
            array (
                'id' => 86,
                'g_user_id' => 86,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'dnGFqSBcdFvUByKiQzVibMh6Q7aFsW8jGVG6Spu9qyTQlGGaX8kzWqvQF7SSSUAN0EspdMN75sDBDuwGQw8VeVxAmSfo8KXN1F5r',
            ),
            86 => 
            array (
                'id' => 87,
                'g_user_id' => 87,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'PR52OGK8YMMIslXwOPBPmrGheVu85nsR8JAhlAW6uNzY9doSURSLoE7x2S4YboQuc46o0jIQ5uKCmlWSy1sIKtps04y1hKHmzCcz',
            ),
            87 => 
            array (
                'id' => 88,
                'g_user_id' => 88,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'n7wBKa6x11k1H9uU8cKihbVknbmlHxcKbdVCrd4HHs1yWYsbsFCTcS3uxQbj1OY4W77pjaOhKx38CCFhN2lSXho4Agcf9ldbOxGw',
            ),
            88 => 
            array (
                'id' => 89,
                'g_user_id' => 89,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '3zjo1vnusbyVOiOiWXcjOXlXa6P1mawhUv66qyKMs6ZgvR35GtqXWXakjuGYRlKO7Z2th0TsAUkQOVV0f52oj3DBF4ym3Sa82JGk',
            ),
            89 => 
            array (
                'id' => 90,
                'g_user_id' => 90,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'ISoy4hPqSlxiv2roYsePMFCoPgJBWmP1V03vbXx1m7w1lqi0eaP52HU7ZKNSKVAXORS0lJHDHybYNAAje0ba4jyAYDgkR3EcROxw',
            ),
            90 => 
            array (
                'id' => 91,
                'g_user_id' => 91,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'YWS6HZ2eRFchCiDTB7dEFApPy2RFJkLFpalKLgw4BVRMA1kqGHpyk8yVvIIGhzP1DjeV4psg3G8NOGEXcMixlzZ2f891u07CJr9G',
            ),
            91 => 
            array (
                'id' => 92,
                'g_user_id' => 92,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'PzBaUnP4otEL39imEP6coO26UZljYTC3i7T6INp9ftEHuUBhwN9L5OGqGgkQWnWW8KougDAt2PFyubF1z0Uo1XYhM2jA6J9vJlcJ',
            ),
            92 => 
            array (
                'id' => 93,
                'g_user_id' => 93,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'Wx6iNINg0glao8qcXt8NBxFjMZMmNt4zyDwEoidQ7N3dxFxv3lq9jk5AHSvpkC013SlQOvbCNhokhZoVqEFRJ4iBcgqzBbNO7y80',
            ),
            93 => 
            array (
                'id' => 94,
                'g_user_id' => 94,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'Rmt9lqX9eNFrWJROFXwsIe8RWcdWvzH960IxxmSrKlSThdAYT8TAWfR235fUq87VvR87SDPI20JyN3pGkxszhtTIm5fkBaolfLP7',
            ),
            94 => 
            array (
                'id' => 95,
                'g_user_id' => 95,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'GrewL74OlX3bPBYi1OXQZKOJtYfkhyWmtIFRiqRUphXaG4ByFQvbdM9xxbztTdqWntkJHYF284UNDkaNPiCzIc9EEZ9nEf9KJ3cY',
            ),
            95 => 
            array (
                'id' => 96,
                'g_user_id' => 96,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'ClJTd9Ew2Ct2ntHFyYITTQHiUuTO8w3j1Oe0EAYgJxufz4jhQQkgGBk7KoGiyF3q2aU3j81Zrp5qfmAFwN8b14WFm4fgJ6LpnXNh',
            ),
            96 => 
            array (
                'id' => 97,
                'g_user_id' => 97,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => '6arJP2RQs12okL3pYVJMg0Z87I9emdFcv7PbcjMbEv7KTdKEUf1XUZkAnfmWGue4lORpfQ0iRAgcUrF7l9z5uQyr2gMoBnWubzSU',
            ),
            97 => 
            array (
                'id' => 98,
                'g_user_id' => 98,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'l2LwTAAV8aa9qAUs2OgwHIciyu1XxqVrznlQrZ9gptVrxBkGRIQYJiasI3luTXRsWrDbAcjUSfiwiVtQKBE3P8XIOYJQnf5cX6tC',
            ),
            98 => 
            array (
                'id' => 99,
                'g_user_id' => 99,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'wPEnebpRods4Nqv47RQxMY2sM4t2wOiz1eCE9tEQZAIyRfMBwswtScykkF7gHXkjv5UTj2jcI5tttIZr84F5lpDG5yoXocMDdRP8',
            ),
            99 => 
            array (
                'id' => 100,
                'g_user_id' => 100,
                'email_sender' => $faker->companyEmail,
                'email_receiver' => 'aMTBspIRiv27GWsEzR5aePKOohj3PemxQ6sPIfirx0h4Qrh2ufQHxg84tUcb6UzFqcbmVft07B2h4S95QJ5DmRnW2wKBE8GtMYis',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('audit_sended_email_logs')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}