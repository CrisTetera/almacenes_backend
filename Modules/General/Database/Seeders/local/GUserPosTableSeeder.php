<?php

namespace Modules\General\Database\Seeders\local;

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
            1 =>
            array (
                'hr_employee_id' => 2,
                'auth_code' => 874,
                'bar_auth_code' => 'U00000008740',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'QMk8OT5zBA04l1jqiGTVouhtu6qYbCnWRHNDEPqw7K3cVFxfbjInOVayUh513DRRiLp6tBuRIrNBaJkBGhfYivJYuQI1a2EiRvyroyoJr36BxCCNGTr0JWq5KlBFsIuVSlCmKFW5xpjdlPvrL2GQo2GH8SlRfFlQHN3YBDnwYq9luceccsoAIxPqaNaGAcMa1Dk6tiZxPJMHJe2fwcA9kis658JzLVrRxEUvFEkepc4pclLPAZYZjscR8K1587A',
            ),
            2 =>
            array (
                'hr_employee_id' => 3,
                'auth_code' => 873,
                'bar_auth_code' => 'U00000008730',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'OlwgBgrv2IbcLA3AKSZRNkyAnmosIpSowYT4vJ7MysOricC5XCnY0nbPol8DiZ8IFmgFU2fv0p3t69TK3nxLxSItvJEJRIFmDY6wyOfV3Iq6yc3qBollZyvuCdPMqdHgJOpUu6ixlT8qQMuJDe4r8dlcylYaeNDo9Mman8CIShDcRASiHKed01BZwkq6XL6q7jG0s1uSvxo26MqKDPYdVeZGUl9TXBTZV1A2cv3cAkZQ782ISnejJSnBQPgzmMA',
            ),
            3 =>
            array (
                'hr_employee_id' => 4,
                'auth_code' => 872,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'G3D0dJvv30czo5yr8KlXsNCpZF6Pl8SlIoRnuCr1NNNGD9ZiJNHLSpqXsBmO5G0EfJUZDtH1ldGlOFJZH857xlH6OPrPvDM847hlwXxaZszVWzRVsjabLAqkijhyHtHOy86unHWXEC7RWRDVTfZzgmOTFMzr83OyHgyu3u51r7lxVS0I5qrmJ98PgIO74lROoMpaA9uTvxD0A3KUl2r21jMLtomV6jQ9nZ8JDrQddjBaBGP5xNLli31pGalbtdx',
            ),
            4 =>
            array (
                'hr_employee_id' => 5,
                'auth_code' => 871,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'u7vVVkVe2udpkrkuo0W5aWHiN05tFaR60NkOmiZm1FimCWTJCBi0xTlJ7qi4poQuUfHbe3Zs5K6SKGrOCKa0Z0oGoKF6tJkU69DnnlhZvCEXWjgKECnz0UQvyyzv5QbXNDhnISbb71G3x875NIcyc8gePkMfIl5WjoBbNkE62w3whExPadCIgvZsfhfBmwLkIrNLRlUr5L0dAMHoGBdo4Ui3X2WUZDOgyUuHidfvjJwPimNOxouJXqU0hPqON16',
            ),
            5 =>
            array (
                'hr_employee_id' => 6,
                'auth_code' => 870,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'VaEeXunl9qZp2nMVEpcrKRKsjmgmDpCk2ZbdNbNL5io067I5Yz2n8ZidMRVG56eH1R1laENHTiUmopshFwvv2LaDDHviggErXhd6LCsUILA8bU8yF32GCWziLFQWLslCGOMWCOpHQv0BuyugQPgsdEbfei2rmIzMFeXf7m2B9W4b83cT8VTHfIFxNenbWCdHdaN7sHFhwugspafE8roVZHWAOQ4rPr2YuhOvQQHVgpUInfkJdD6Y5WQ3pC1OtLa',
            ),
            6 =>
            array (
                'hr_employee_id' => 7,
                'auth_code' => 869,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ibiiCXQpkLcG6iHx5oaTsKKsYkGHiXDhjORn9jqZZe48PdQ6iihBg885OHcqWjZvuIu7yq7adGgs4A16Iq9ILrAlR802stKkqecWr0iL2zPWs63jVBZZ0SJJMIJAID1hH78tXpmMt9M22f6N7TZ2ZZPtfg3jh1IP2AIQTHBn3yvkcML3ZD3H3Gmg990RWGbogPwaMMc1pR0weSowIK6iQSzFibOzoTjR4Hrv0BUrGGUs2Wd5MfxPCr7Is4blPKo',
            ),
            7 =>
            array (
                'hr_employee_id' => 8,
                'auth_code' => 868,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ekT15cLH4Ln4KUPQX0P397L39UKoJbTspMZrQVxGSDDPtLjxeXLq1kvley8tJKr3EHvXltmP01x0rpSV45YwIcTAR4ps5lcomSkIcJNkNbW0zspKRdU8DzAXWb6T8YpOVrV9AnvRfs0vpemdIb3nlPzK88ORSFG0iukQ8QECP3NMMWVd7D8s5GyS2Y4fqS4tIsU5CBdy5jtNLTWxAaLUXuDTS6C2f9pplTEfsoAPcIv0acFwB9R2HMgX03PgIGz',
            ),
            8 =>
            array (
                'hr_employee_id' => 9,
                'auth_code' => 867,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '5othtxH8fRuz2HIY0Uo7ZTPLtxFc4mfBoK5Iz3Wp2leIuehDj0jh419SrA7GfzTowqfToEicgvPPFKIBFUvFetgQZa3Sf2wYfDgnmPwrEIAkjTXxz7yx3Mzso8pAbLrbBso70wUR39zvSHZhLII6cvkmWW1WAFN6QCeZUkELZ5dJY4a1jQdgBqESJZu3r2CS5GNoaKAjjtKqikQwJBEmZ0Ovfz3Hkz0wt7AspeoBxZd4BQIHiQ3aj9LKMEhLHc3',
            ),
            9 =>
            array (
                'hr_employee_id' => 10,
                'auth_code' => 866,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'Nwt1NCnhuYeRzSu2kmjOj160F7puysyeLnFBJgotJNG3D9oDkFD66AiMm9tiwpo3FrTYDW6Qg9BrVw0vx8Li0D5EONbpMWm5GV04fJFdRTRwzhheR33kcKygB11XsKrrboVJ2kJwnawB1ohF2ggRy1DX9nTvuSZUnMnLov4erbrTpSb1y1PAanuG52l6C5zIYn689dxNL1LOmpemBJscKXt5yJRpchh6XtDnU47yt4Rr7wvo2HY9NtGQmlhp6o7',
            ),
            10 =>
            array (
                'hr_employee_id' => 11,
                'auth_code' => 865,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'KcftsYAXUMtstxMAPiSuuNbESaybhYRR9QcDVVytEPgDIDgOBbLWtrBrqrnc9XFGAkrIZIgeAZyQqQ8cIgSgm6OV8RvvIMkEfgUpX0V2GGX5gvUR48tzEQ0smL3gesN3nxDQpwAUimZBI1nTry0lsjWRVHGDPNjMiDuQ5XwADLeIpisF6dpqLWgcjj4iMSwVrBJss9w82HIQELXJwvzsvBtNYbZ4B4JHUevJCTgiiqe4LdVEOmHqZD4Z0hQBDWu',
            ),
            11 =>
            array (
                'hr_employee_id' => 12,
                'auth_code' => 864,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'gvtvgn96wWb7NsuLsX2IFxSG91DD8gvCLZ92mb0UWbYcfH5QpJ6ksmNL9uVpFPNkHFiCXuub7cq0Gh4Viqi389pyjRFrDQOzDmxPaNxVSMxNVRJMnvzdgNtwznueZ9OBQUo1859pl8L36T5SHXFX2JuTXGxWbKVAnxBBj8Dm04M5bHTgJBdcfZ2hRsUsfrbSKTfQNh0J97aH9Q2gXAbaizFVLjTAQWfqWEaNWhiknZtzjnImoJEEYAykJHrytAj',
            ),
            12 =>
            array (
                'hr_employee_id' => 13,
                'auth_code' => 863,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'uODwTr66SPJ0BST8uyeoSANhmvyDgtTihbjy7UOEthuzUvURrvM2wzkA4JGRtnQ1k5YYqdADfUBHzzZ9qrkFQrhxsiGrLtWmYAZ8TcWvrp68IisXmUvdq8vskgvL1SZ0RYOfVWXymAUb0ITDPTSajIirPlWmGhbYgvirRABigWhe5DxSmVVk0kk6BzMYxhixEAcvgwGCodi0T7Jrf6y1kMaTghNdY3fKuBzSyRYCObz9UtRbCNi7ZuH41mt39Qw',
            ),
            13 =>
            array (
                'hr_employee_id' => 14,
                'auth_code' => 862,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'eqoIjbMGVtgvUncbfiHCvNhGXI9D3Z7iyOQmHBhhOvhRRuMiBvNF0zof1vKNeejA5YXhvHizfvMuoqREd0pylCifqU4cKaqmoMeR5cihwbLGC6Sf7xm8HQPBRT76QOUZl3H5N5bEzYATu8VZMQA6ybyPsPQA6XfTV8VJD3GHmPH7IAZ9F2R1qispQMNwFYXZLNCQdSvsphV86ZYp2Rok0D3RltWPCCX85ChSPOHvckmuqI43zP5JE2wceSferaT',
            ),
            14 =>
            array (
                'hr_employee_id' => 15,
                'auth_code' => 861,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'iSvWlJIOeSKfra1KH3OklhKHP7SJZcm8vx3ozF0dY4F7fgITe0guq35Cm829mFykSoAOtjLn85PO0TQya9CgK0nr2sPVWmRMPj72jvkJEDt5JiXxvmvMZrG1mIHfi5AG3Jo3FIOQMrEf6wHtxBTxVFY45jP6ZR0zXlMWkH4u2apcIx0yCp9RORMvGWB5Ne7v3JJYN9boDdrEFN7PkRc8DOybE6rKp9p2ekTsAWsdvBPqR8n71aExcZgl5wg2y60',
            ),
            15 =>
            array (
                'hr_employee_id' => 16,
                'auth_code' => 860,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'SW5KnCNNVRS506XCQQlioDrS0OMiARsHenC8Lbf8zdfcZxiJ1so610mOtnnspG71s4fcAxPdATtd4MYobSqmjBnDETNDsNCv1VKCDGFfArVcscEhz73EE1SCRshq9s06hP0qetLPPVU2108D4NnM7JD0diwVaBxyNGQitWq9koA343UtWzW02yOa4yut3HkeQ057xYQsKGPsoerGMNhLp9XruXF0sg2VEJ8bJNBRcqPJ5GqLDQ1OE3W8KcePjWi',
            ),
            16 =>
            array (
                'hr_employee_id' => 17,
                'auth_code' => 859,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'iJoqfHF3mfwknhHtHQ6vZSGkMPpiQx663dhV4cNOxgLxk6Gs1pABIhHPPHwAUjG4yaWHuwzfT7ZoplRWpjcXQCWHNd2haYZG1AerDjp4EDBRND8Ey4wCs4C9zwAJXVEKqgvgG9RjfQKLB5wfAoTa4ZRhQT3uOaMWa6R7w9k2EqHPjls5cArhfBFZZKN4iRDPlRNX40G9D7GA9bGu492MrvRYbZ4WAAFUTp64ZASrAV8KOzrl2lRNuy4MnjNgf0E',
            ),
            17 =>
            array (
                'hr_employee_id' => 18,
                'auth_code' => 858,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'f0OAAPlpiTTw4S8w9GOoZviTMsa310s6dOqZ9xx0cdHb3bGHl3UvZmisaTtk9fNqb8UX9mqldcvxHHNbKWHCHYG1YWehF08q19Mw2fSixDDl922MwRTsP5rTKYG566QWQsUFvez1b0Gw6rqo828QhC99BupS3PTTPCpBvnyQeWxy0CZhEsDG2bs1HCAZ0ESCrAnYHSqYD07PlWTOwjYzKSueXYhi1XjtwxtWiZFLRD1rESdmxXuThDMuni7DbCW',
            ),
            18 =>
            array (
                'hr_employee_id' => 19,
                'auth_code' => 857,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'NHk8zIc6lnMkRCNvTYj1Jx1q2EUIjbO9TVkwc8ukTfQkDqYs0fqgiWqvTSMGCXPE3uDOfGg3UXtPAfXQ0KMRGwQohgONTNhff3RRudsQ30BnT4LSQRphiQQ670IkILFJBXLsp9hKVKE814Bkdbkb5u6ZSGEyaz8GU2TbWawmHV7phuyFdSMLWlCWQgFCwLcF7xWfzZ9BB3UWBci9QroDVKFV4fIpyDFLMgoB6pdmRbTmG4a62fcZc2RcBWXSfrG',
            ),
            19 =>
            array (
                'hr_employee_id' => 20,
                'auth_code' => 856,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'JbqYmKbcf5KbsYRx2sR4LPMKdyKdAb9dZLVYn4Eam52yI3IOanO5yzpBTwkguijANUl0Xj6WX08tIOvhVAyl3hCIRIvp0JGs1cIQe1OAo1PIjU80gwvi7Yib7OB6tGZD7AdXtTVFF1LbnZPMVXWmveNlbCxcPOKuurIc97KRWv1Uviafog2hHnAYeQpjmSOQliYruIu2kGcbQAerWEF31APSRP1M2dbcNBpTVRZ1OV4eNVL9MQuLIsuQjSJaCdj',
            ),
            20 =>
            array (
                'hr_employee_id' => 21,
                'auth_code' => 855,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'c4yFc5NCrxCkDlkOEvrxoQpP0yGLlpBzObvrjtXiDD4e76H4q85hOQw09mrj3GYOF6aFyrHY2bDJeMGGBPkRkhNnuHlItMI0vpiKfk9DcJSo0wMjh8mxPNMcQJEaaqSBQcDtyiXoGtJNAp1i0sMFx8JsF0HV4Wf6gsBSYAXupPTep8ufAD1kLnp1vi1pBiwsRsoryThCr5SLIngtcMQjigvZMBDJQcjfehfMriQeVAWgcBVgLIIpCnFraPAnxbC',
            ),
            21 =>
            array (
                'hr_employee_id' => 22,
                'auth_code' => 854,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'HTgvHMtxmbeUIr1PPnmoeHOfE30gbFtCZIgG8T8jkpsIgMT9EzYW3vKpKmMDtoSRaF36AMaCVcFgDKd5TA0jULjY3B5I7JVYkwNddEt7JeUnze4LxmK5pYCpvR910rlsoZx6qprduusCdm5Si1U2gaZigwTbux62C67UxOwhd6PQYP4XE0lwQA2MBAKXlzS7Zl6IENPehFiZwG5caRuHZA7ChEOCOLQPFCWrFLBIdbhyoCfdbCvzBDIwwXal1sp',
            ),
            22 =>
            array (
                'hr_employee_id' => 23,
                'auth_code' => 853,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ehPRUn5npEgbyF4AU0k9j2zBcI5l1yGIJeVQ2aO0GKTfg4rpvN0sFskq30WFUTgbAFCXAS3CUTcy9BHQ6WFGa5Ztl47B53C5qlZdLmk4v3wXHqqE2UooDfGOwrLuEVDHc89Im86M4T1CvNkI3g0shmSTxHam0sSfJq36wTMwvjy5Y7s49v6qRaiF0QYqd0rJpPnB9QXJtsu0QjRwq2hWthHpNJu6NvL2seCBKTXOQG5sroxuuNZ0FnlNJgIQgkg',
            ),
            23 =>
            array (
                'hr_employee_id' => 24,
                'auth_code' => 852,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'Gap8ybXd2nJhijoUji0WLfeb1JZMQ2hD8nmHgEXMLen78sZWw8yRtXSK7Yjjk1mUnB4O5ZmFcDRyiXMGArVb8sUZOLMy3XCRl9xu2ZlAx4D5jEeXhQv6vG8KPITk4UxcXlKYP7W2ijwzTdlqwKHdCByYo4sU1qdJ7zxRYREmX0jyIptOKOe3dbw6VjIXoDWf6DYt28TLob5iGIteFtn3iyw5PZFTicxzDCnf0WnVJ2s9JiMb1J0xd58NjAWzGaF',
            ),
            24 =>
            array (
                'hr_employee_id' => 25,
                'auth_code' => 851,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'LZV9WzVHDzoBaM1KeRj5pec8nsCS0yRFYQ1tgEvaSM1byT3WmL740dil3BE06x7HQpwfw3DgQAY7V6CX0GcYeEsUiJxlpGJoSGXnNm633PRoMYeXKLXuD4WKrI0vxGyjMzXLpSsRVa7c4z3nuJvWlymyZsk9XnOc893MKbkAtC5VxPD7R7iwz4XsNt3dCoq3ZF3Dkf0GdmLqBMwX8FtZ2MHk3g3Kg91IdbeXGv85KzGCLfL62OcENUNWmOvLseV',
            ),
            25 =>
            array (
                'hr_employee_id' => 26,
                'auth_code' => 850,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'HSSXmyx6ibQo5GbOVfEU80AgVGRupr1pYE1eg0z2j9Jl9GaxUjpkSWQL2TbyJQP8RlMTymmnmB5eqDpMTZOt63Y8ChIlqt3wDVwgTP4IjFc1YGYchaqE6AUZVYWGS4ht8rDcTv56Gv3ixSvbhWBX3Zy8wyJtCMKQK53XdKg4z2PVlLfMX0PmmKDPfGlE3wQSRkvcPL6e9X4B2KdPlpifxpDmeyGBJ3IWhSnTMOKUiMKFMZjKjZ3jaEhsLt91vFS',
            ),
            26 =>
            array (
                'hr_employee_id' => 27,
                'auth_code' => 849,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'fGgBkes8Tlh8ijk9J63KGUVYfeqrcJGZTAWpsHkNn8nUraVKUsovrr7ha0AfmC9nsLOdlf902HLQDT0eDXgXrScKi0PF0DStEKSlqIPh9PaisReCkansPOvpE0JYCB81I4HvQY4dn1vfOBbWImGpUYNIikO2XfeNlHadYgMDAF9L1Siwx3wpDrHhU6La95mSVnDOqfneW7cUJPZ8obQJC1KHPZKzHbEhbBcnFXL7WxxmrRUBJNBQ6BZME6CT3V2',
            ),
            27 =>
            array (
                'hr_employee_id' => 28,
                'auth_code' => 848,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'LY0Qg8Qd4D7GMzxp2ulanC5FQ2XeRz532axa98SPStbnwVT5gUmdxNmvvIOuSfzJNTVO3b7mfNSM9stkR1rH8fGMuEUlA9A6HO9gxluhWkdrcFxEWcxVi5Mqa2VJRyscpV6yGGt81vsgT2oJa60TSnR09MoSWUxwRgySThv992yWSQYhQo9RGQQxqvWwR63uyKFaIGTPFccHhrAWECUA5illnQUTTbF6tWFxJQL2gPDIIlC3vWiBW2qx9gOl0qL',
            ),
            28 =>
            array (
                'hr_employee_id' => 29,
                'auth_code' => 847,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'dCxrS5ZeHc2v9xVJAoKKSYtMNUZ7GZzCC1PfATaUfOR2eqbXxkZg8iyHc0mtsAhW0KnRPfZXZRot4JW48g9r7p7coeNynn0v05UAVhJY65rrCygBRVPqLzkG2LYkqtDlLcp26eU24NEqptgxqElOsbfA7Ib0vp1k9k1BlabNuOG4tc7yBPYqMHZBStCNSeX4pF9VB7ZEWC6MZk1av4URrjtCutJYMe0J0UY62ACUECRfpqJmDJYnTUKbypvmHGa',
            ),
            29 =>
            array (
                'hr_employee_id' => 30,
                'auth_code' => 846,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '819jqIe0P645lH3aMcdkRmZr6KfmfizoSiBXaS5FDWUYdtX6YEqQvMGIgph5sZenRr8BGRKTEg45Gbm1EhTOrFe6T4YCcOZicr9FLSDTTvBGAxKVxBAWETAZ5JZOaeHZA9ZMyW98tpUQrRs2hrErMdPB9tLP5zRuTTWbm2vaPId8WqG213qR8dvvbjNpk4iXpZhELV4W2iJqvNGfsAltkNIGttdBviTf6cUu1j0VCwsJ4aOrzP4Z86cKWv1ZpS2',
            ),
            30 =>
            array (
                'hr_employee_id' => 31,
                'auth_code' => 845,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ta0ZNNw52dklzWGVZvNPPjWZ1mXt9nOhRxcrFnTmXF2JTrAI9b6qlNjP2iLgRin9NkIxWJhx4V6JdidpJiKqfrBEFpisBbcP5jFr3XGZTQ8rTOzQOwfS1zcMdehHVlyScpOT36HUdSlA29acHExtIr3bc7x8H3nhQBuDN3eqImjx0cCekZrk2nmLbuh1FbzuXBZ4s7jdf5BjJO0XGKQ2njNwuqr3P8TH06og7JC0vMhvAe5yVPZpZo2athmrubR',
            ),
            31 =>
            array (
                'hr_employee_id' => 32,
                'auth_code' => 844,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'JLBu4W7AYI9h0kguVeDtANBdWKJT5HRdQgvPwCAd2QHqcqBkuZSkODCZo3dD2QfWRMky4fdoAT4NH5qyzrqvaSON2DrU4y0abEbU6TnWjTKjI2AgLSxXiS8i3SEfi1UocD8Lc0NvAcEMot4E9Dro5vEeMlMhCB8DMDlVDVh4ZuNLOsq3sfS6cY9AD7d2hqB3vPn78p4D51IDVkW1hu2bn0TasFqFYwO4xQIjIC2ZxZXsovD0r6NCbySemgz6XGJ',
            ),
            32 =>
            array (
                'hr_employee_id' => 33,
                'auth_code' => 843,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'wYZLQKG4q8uO5h73s3CeXmj4ARn82ea2jdRRmlyNa6roQRfL9FsVpZWGEeGLLrivHqCfl4zgtIRjEpIHBCdQ1oyaVzoBRYFhq8FvSSV7ggWpd9AvaU4E16qo2TUqwx9b3j2tH41VspXFz1Rm1gZf5kDK4Z5o5ICdN3A9yskonb4vfxukkM4BUxyV9UIOzjqnIAa4hn9sFb8nGeNqesxDcMHulZ6dcB1YrtopoPJp4I7ICJLRU8QBSSHFEmAeMVW',
            ),
            33 =>
            array (
                'hr_employee_id' => 34,
                'auth_code' => 842,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'AQT6AgJ59L1VtRJioFHQdfj5ZRJnYn480LB7RxMC4VAXjhyzdAhhGE2GBd0rFdfyqLKYLuFO155T0IQaoF4Id276JAjisbtcAB6PzCEYHlZuGGTioj69mUsX55XuCVQMnSynTWG6P6lz8TAgQgdI5wQ5hg8zdbp7Q8lR9VrgBP3Wkp5YCbkNP5yCHAfrPAvrj6775oleGcTbfK57IamVaU7hZXomqMSEmRemLFi5LlamCe0zEexoFh8qnQfFFbT',
            ),
            34 =>
            array (
                'hr_employee_id' => 35,
                'auth_code' => 841,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'x8XbgNQ7NY1lCa4KhwvjB07qVWmLtS3WJIIuaIMbGkPi8e2tKf43Tye9bmb9aFmv6JJTjzYvNhQu22mmncCCdmk2qme658B13AO5obZ0BOL60JMXQbSxtq5FJmcqqHbEPIOpcZ1aHUuNjDHzkTit7sKSGKuv0xE7flwYmIid6yNJYd41NmNe5uHPKuj9Ut7BGdqkC8QXCKpvbBU7A6MtV2ot9AoZVFYbuZuZ60Z9r5Om9eMyzH1E0fH3l4c5BfM',
            ),
            35 =>
            array (
                'hr_employee_id' => 36,
                'auth_code' => 840,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '7AbpkaefbnHtosROQ75FKe55vVCPxEZUtQ7jUdqk8VMwKkbRTn1lbZb5c58HbfOPVdSuvBDaNqq7LWaigmuCVUKW35snaR4zbAtROVOm4Vciy7qokOEQO86AyhQSBcV3rrW2oHB9nSb2KwhwVx8071W1n3TSur7JTrl5nVeKvXmBLgSDgIxvK52ygD9CBtJqkZ2bEXXnfGLe3FZ2cVhEGq2CQyhXfG09KToVfOFgNA26tAmTyqcyD7wOs0oGFMT',
            ),
            36 =>
            array (
                'hr_employee_id' => 37,
                'auth_code' => 839,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'fcObcbd3wdacFgDAIjKREyaC81VMwirtNeXiktZGEkTrJFDC373nkuXu4JgKRCDlvA5ZZKqk6TUrzC4BIbKEYqkdlbd08ErIXXH5fpTl5CvLRHMtMmNFBC0e3VYTtzXMpwn6YEueItH2bSVHwKS49vcGLgRR6t1ftuj6CSYQRunRWJbVudQXgU9VZCmnXgxq7kzHEp5T66QsHOV46nmtU4HDBSEqUgyRCE4JKwbjhYbnItpTL8JHmEduwSCEXFY',
            ),
            37 =>
            array (
                'hr_employee_id' => 38,
                'auth_code' => 838,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'e78PsCIoGFybMk1jSWp8P14ptSbe1N20feoM9HPh4EATqno3mdQD0UzRGturv05qcv7DhTiwrdtluO3gctGA2cWruLKSr6bdJAiGJQ0Wq50c3LKZPBmkmptBWt14hVK9yW4yUAE5YAw16iX3itXwcJaZlyYJXfxDFB0clcOdt3uCyIyX4MMFifDqi6CSeTSK6yNX5qxAGarArRfYtRpehnDZ2OnjQxWLDUqMYV0TVCZfncWDz23KsvOY94VrzHu',
            ),
            38 =>
            array (
                'hr_employee_id' => 39,
                'auth_code' => 837,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'KzQsU9tU4mBmSSgPWCM2tCHt91JsuQ8Ns73XbTTwwWJ4gjhkyicflx6OxFktLcoTlOQ5MizNY1l1dY824eGmD0YuzOYnBFQvzbKnMNynFjCsbSgf61SBR9d80Ll6mnywmWVZ4OillkXlNKWVS2DuQj1mFLnGCrhgsrs2am85Ky7pJosvdqcz8hh6z1bHpGkNHzQFt5Xa2lFoiaNjNV2DhOQpQSTcSOx8kqITX4BFDva6EMXb6E9yjoQSptGcg5m',
            ),
            39 =>
            array (
                'hr_employee_id' => 40,
                'auth_code' => 836,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'A9k9AGloxwMcO4n40A2h9eP3pz1JHJ2g054QjJiYWc0ywl13EQyiKBmgIgbYMzgIEyCIDLYgrsDd72MMbFw2pra4SoT7mOADoreXDe23fWDnD4W11RsrPftg05Xl7y6bIrZrhO1dXllwxknzC5UZwk19JeeZQPkbHVWJgnmF8Max7ohQytRdaVQVsSmyo6tG1Ptkkkyv3ZN0a7OcXKqiTkVung8YOYBS7AaQmcTEfpEAxqpUk07rdXrBi49cO5W',
            ),
            40 =>
            array (
                'hr_employee_id' => 41,
                'auth_code' => 835,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'i6usJFYinAJt68V1AVZZMEK6N86moeTuUWDPNGFmCbx8eJp4zCg7iFDKEQxR4U4pNK0S0rj1vJhNcxqP2fxZVJ7L69I1PudSVZaV6LH4v5kKipzuH1f8KfzEeio9fYP8Rz9wnioL6yYa1bjKsdfFWh2g4bohx8cS2tcCJAD4YMnwTN5wMQdcbYqeXp0ZCs4UjksXYK6sqNpT4KFwfP4nyrwvyGsx5ZHU4dH2FQAaGLYNqXrq9XQdHAMzqDqrgje',
            ),
            41 =>
            array (
                'hr_employee_id' => 42,
                'auth_code' => 834,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'd9WbftJqxUiHntapkASK9bsc82RnoTuzoX1PTGb3EmNhPs9gIm6ZiOvERcOJWTb1BcxTDJlmxtrUBsRAnDvYgiybKLJM8AfJiiani5MMrWwAUseWzInOPLgWnaHFcxnNiJo6Gb5f7oLghMzda0Wk3pAPQ1MjsavlWS24GtGDweFmUugRyFzjC0HPinqb02mW1bNzdGcciMOU33h9vhtktY7EJVBV8GIpKQfsedxCmum59KnvKVnBazfg3LakdOt',
            ),
            42 =>
            array (
                'hr_employee_id' => 43,
                'auth_code' => 833,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '36eVBUrU73WqanuZjMzdHzvrlq0X4aIalfKMrpauAP4BBsWufyGQ3dCO6CKpOMn2HKhPmM82So1eYl5bHnAK7O2ZCE2zc3kCuMOCvPsEAFbKNO2I9BJoIP6SYiZWIV0dm7k368PVovrb5m92eSENJEZlU6PhpAIJqk9YeEv7QYlJbBO7OTKLS1XMGTko2dBt7h9eh9nDLkB49Vz1GyLYKLRr5mfDlg5F8ZhVpkJ891gHnD2SvKZ5dfvDwmpnSvd',
            ),
            43 =>
            array (
                'hr_employee_id' => 44,
                'auth_code' => 832,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'Yag4yod7gq7tylxgvX4EM00SQBcn8SPjQXEnpIfm8mHtBpeZCuuTSMSANIfxGzLmp3EANYOHuFq6gTuBQ8Z6Yg3KRGqqt7pdd25hCRFafc1s3SEnyb82YNvERlt4Kuj6LSqSUFgNaobR9P8fgwroGtg8ZAvAqO3wrwl8BXmzewb5zSEzsl0AANUn1NICqUlfJegvDDNTvGnDrzS2qwm6WDRyTOgMVh0SFJDVS01T328Pv8xAu7tfGDhw0mowipf',
            ),
            44 =>
            array (
                'hr_employee_id' => 45,
                'auth_code' => 831,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'TEZ5lzKSoC1Uxc9NZa6k0WOp62Ielq39FsZCaFitoo31NbS254iCGVoMrtu8ZAII9YsLSkWUjFz6rQFvXDn4oT0ofLNErc9uqRWBIJR2gupP5SyEbQurpkg7phYUH0xDcxHHlEBqMKVEUs85i0SyEP7PqkARo2DK1vMN7Uf3hzly5AiPKsigH2haQZcoo55HMBLzKKHAue2FDO523oODoZRfG0dVepBhFKmTG0GqwviV0Bx8EnKMUVbEhpKBwdv',
            ),
            45 =>
            array (
                'hr_employee_id' => 46,
                'auth_code' => 830,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'GCFiwnqfLE8zt753zfO64G2auwYlbABnnEpcTsZSukXU3x9vXUrDaYrhixy3fHJHL6yXrWtKroqYjYIdEhQXL5elGh75ahSUaEdovWv3rW9Ikun4ZxqRD8CjAlwcReIHXGMyECSGBxjpPt5YaiONv66mqWjivo683hRQA9E3bJfL90wNP2dHUbdDH5Y2vapH6gug3B7BH0XCzKe3BLC6z8Xwwt4Ac7piuYf7FDcgMAABcOmWzKrpKh23Hb9hDoT',
            ),
            46 =>
            array (
                'hr_employee_id' => 47,
                'auth_code' => 829,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '1zEIcfSRhJ12U0oloqBrDfATCjjxL4IS8jPTPfgpHWXB6VoLFZzA5I3crAv9ajBEdZpr6fZKA9qrwDCEFPM6XlpyqQ3vKwvesDn01C3yZfn5aLADtgTEZiHkUhRd1UzMeulpaK2n4CrNItlzxtdANsIjVZfpOgdNCSNepEjbmokGhxqoaQY78TUVtORIST34o4H9p9BluePvuVKC3S4dXtOLSKGZp5ATh26iXNZmY9UuQazhHZWvTFscKeGmowE',
            ),
            47 =>
            array (
                'hr_employee_id' => 48,
                'auth_code' => 828,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '60BJSVDyvLiJs5XTBHT1kDqcT5SkukMj0HqWFa6RweNgQFieE3ALc3bZfKPFhW6GkSrRnot1CDn4Uv77fr95rMY8cQ7Kv69yAiO2SVS9WAJJ2R3ythr7ayLvf5EM86Ha6DiRe8tSCyHaILIRsxXBmI11q7YgRvnVxEaVDK748J3LqBWrWChSwqeMBPAjN2jw8EGl7B66jfwX3orcfJxubqyav0Tkq2hGN6JW1g5Dnquh9D0RFlWN51NKRD5Ah1z',
            ),
            48 =>
            array (
                'hr_employee_id' => 49,
                'auth_code' => 827,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ocdymkKZXTEX8sFWO2v1eaEC4SNu3vHIvVw3s7GoHeIwwdatpNTglhIoViz4WYMI1vLERaWO6zifogN7IT74Q2LtZ5ucvYZ04eqJj2MIUyibHQFXE1SImUPjOrOkf7izVKJJbitkm2PQWsvwVCg8MaKstCIB8PNcvGMBt1Kew8NOD2GjVwtT6u9AgZ1T2pMBCS6Bm3lLbyjcbTHO92pukmfMmWBryC89ZqjXhUAcMIXjNR1bMllBjZETSYqK1Sv',
            ),
            49 =>
            array (
                'hr_employee_id' => 50,
                'auth_code' => 826,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'YBDlVguxvqhzIIaqhfyGQsVzjVHLGJs9WxiGnpb4Hf3Pp2D2ktR0bfOTJOIU5DhP4RT5QPndhwpWp42CGlTMEr4yKEbiTMUtQAwUtCJenYuPOAfAuLC9pSXzBbwrtl4CZVffjJxgCNqMWc0btlgw1BHYFkw8pjIAS5l8EsOcgGXIMqeJCoqAZr3dBeBHfIxSp8avEkHd3WvjM3kyaybdefruNFbBrYS4CO1dLJdrmUkmmz2EsuQX8N7G5vLKLWG',
            ),
            50 =>
            array (
                'hr_employee_id' => 51,
                'auth_code' => 825,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '6jFDKzyNbrDWlc4H9OMQgnWBGb1oNa88PI3iPduO5bMtcJE34Q1lPuToWJi2iAVi7yEaQFpneGwWHj93rz18VVEnXCIf3Ru8VxUA3lHnfKkDM5WzbuDZrDl0sFKlK1WJu18FoT2gfSi7k62YJjztuz4m62QQKbBliM14ukJCwH8hvMpSJ6oNkIbocIinEoqqlhPyzIxrb8OwxLzBzWkScmyBa6MNUXjKh95smGAoWRxGxKKCcEo6n6mzRn9fpPe',
            ),
            51 =>
            array (
                'hr_employee_id' => 52,
                'auth_code' => 824,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'EUlVISsbHBnlHHM9SLYTiCPfg4GNB5azrCAMcZyIU6pveDA5F8RgRGX33lku4PiFjmMIkINb6UmCiA46klgmuISdkzXRFsxg3YbZckcPM0NGNmXAoWUqb6yS5UjPtPGmpNXuMLx0b3MAz54cr7wcpKckF95rtnZukW4QFyWx07hWmVn1iA6HFfauAuZ2cieS3GT6gitqvHVlmZjLsx320udobwsoEUc2lDbYF10aWT2jDE2En2JYAkfRIBNAFHG',
            ),
            52 =>
            array (
                'hr_employee_id' => 53,
                'auth_code' => 823,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ARmXfS7FN2iof5qfNOidtN7Wd23M519eKt5JnzQKoV9hyBFVdQHt8TmWMOmhYd2yV3YG35cO6AiuZvm3r643yYTFXKiL8nJh1ABKDcbGmYXbHIty0Tk7Y4Tt40eAqbyadUwcLJncgUy6xFOMhvf0z2VpPI2KBgPk5JOiq0WJbIqh47ClXIGpQZKWJOxHzJ27qi1YBH9HB7ImfhOde7WmkVG9yk6Se4uvskIYuHdphzLe4Tf6Jyrp0Y4mmPrbImd',
            ),
            53 =>
            array (
                'hr_employee_id' => 54,
                'auth_code' => 822,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'lFY6cAjtdm2fN1h9w1xLdcTsB8nOSaJGyzuUvwF8ey1b4MDjWKli52VYel7OIwoFoQsOlAbib2R59hcCIJDaPE3yG7OMTIQXtGqVzJ9kkVhtgpB05u45YSSv4A2gDNo7byiFxswPWemO13GxmJ6NUoza2hU8JMep0Z7pZKWiq8vTtMq8bV9NqoNd3TYFnUK9pjrDkeI82f9ityNxzjfl1b7qH9sx4MMT90NTyFjSH3ym2NCUvh54Z2AfOMnysZ9',
            ),
            54 =>
            array (
                'hr_employee_id' => 55,
                'auth_code' => 821,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ZXYLDJabLjUo0BA6F6eZEuVUeRtaeo4LtQLW2Dir3GboSBPoe7SlI0G6ELoj9jmUDJTlOlSQeYkrm6l9rJ8EEcagcnr1LVZfVWEK0AqaKAZI5GKWjWgNBPzMBHQF0ILOxLBCXYNn2ArhWfzZ4qUBzE0osVpGtdpd2tZisgsdAINmhP8dZWBOWPlS3Kq2bCUiT0YRZuX0eQ0JGK4TsfNar7UjFiP4hz00FXfBlLnvXWrlMIp7i6SMwBor54hle4M',
            ),
            55 =>
            array (
                'hr_employee_id' => 56,
                'auth_code' => 820,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '7mj2Fo93BVYLzcfuY77SIZkHEBCXWCgBr0GKKj7OAcT1U25YFKqfT7xzkAYUuGpBDIcnSaEGaC4WtwxYqGkcfC0zxLIxI1tnIdfYS3NlAZbZMX6IZ2voMthW4AYvJwrRw7ahFGXn7Zy6QAgCfQFM5IqbgBRDtN6tdxmLuSEEI4wkFjNmqHIxqIosgNqkpTQUAowqKXESGicwSS52qlzwGrmmKRwg4Oa2CYOAcseopn50LfinKkoPcYZb45TNgrS',
            ),
            56 =>
            array (
                'hr_employee_id' => 57,
                'auth_code' => 819,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'l5HkAEbTymng759zJ3ovsJtYvL68sMriYZrjA6Ek9e3yxMT9TDTFSQUJ7z6371dcBR3oUOI0uHNhgxnJp7m9ozOcROqLzQHJOH2IxVpsF25foxlysl3Ur3EIHTBDYcKh2nLFvsRbAuP7fKz78YewB73ITh69ZIdhTDt7uEHj8XsajajSHmlDcHL7oDgQXCZ4toqf298Ys7ZauOj8CoCU1kManVhc8r5zswZQtdIvDBjtqRuV1iOjqdYDMtibkH6',
            ),
            57 =>
            array (
                'hr_employee_id' => 58,
                'auth_code' => 818,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'XnS3ytPvkV2Zrjp088LhzFHEzBw3QSUsxdkeLmsuQ27CC6gWLsL8WOuTb8sk02FqVhR3kJxFc8yihGQekg9grskgRZZr2RnkQML4iUa8YJEw5GmYmGsvhr1CxiXlat8VpjbOurWlNQ1fAmF8Qb4aXtIPxZVEciqGipwY7HAVAk2LHghIt72hUKI5bkUFzg3ouisd0sTUB3aZi3n1f28QCgziKM37zdQIViEdItk32ahpjepI8U4iXF5gropHNQ5',
            ),
            58 =>
            array (
                'hr_employee_id' => 59,
                'auth_code' => 817,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '6CsaaWnvj7HzRksIU3HsBH6VxMiXnBfWeqEznPA7J446d8fF3H5utYRWLoH5ZaUsu4FNCiyx0Xe6ZodwdurKPsZpHpc7riioqFjAOtYBh2QU49WxsBavx0sl9TyJkwm0i12srcitPzqIdxnTpQlTVNljlQTKdFJlhKGcmIYfkGbKCjsH7IKgyr9xdF0nDKZZbYif0slJoTsonsNN2ztg4gKG6xSsiJWNnva1gxrek8qnqIzGmn33ZGq0GY3QF2W',
            ),
            59 =>
            array (
                'hr_employee_id' => 60,
                'auth_code' => 816,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'N2E2ziiAInHwdiTLyiicDywSl0rIKmMnxZeOqMrgc3rS7d8751LMmq7glA1wZlGmzexX2JkX8j7ZAD7l00tmOxmqxzjueklDaCP7N5STsWoS5C5IHpLr4oNLg0VliNSMYyaTYpY44i53c7C6UyYPj2DnMJYl0MPNlX76aPVnmQlzlwnnORotFT8on0kFOWolMhJLjyKuNKJS7tC2JYyTP9yf131B9qCENabkNWWoEtdoOQlqzhoHmyox0iwN87N',
            ),
            60 =>
            array (
                'hr_employee_id' => 61,
                'auth_code' => 815,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'hPfCVVpci3mGNp3NALBjELNiViNKiXb7nkCsE0Xvx4s14453yADHxrMPcBTiB2dAH3KZrJs7cIRnSzZ919WlIRV1NIqaDfPIIPDOrB1N93p5lrKWgngSW43QAVcNvEKLGRyubwxPqfqel7xCW3pMrnLG9QuZcEZur8afIhzJUIO6WL0oAb9aaT2AuJglcQsm2lR09rtsovaC4amuBVbFS4PNMjjPMK0jhIDTehkLsMjfhKHyfCoicv6JF0Jiuek',
            ),
            61 =>
            array (
                'hr_employee_id' => 62,
                'auth_code' => 814,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'yUtJOs0kZ6Ws54B2hYEJVAqdEKBZ1uJYYSCi7lO8OCzl4MMlcP9F0gH40oC4sJCf4zFPwHWQ0Cl7LOhfDXSqOcGP4lzV9seebxqPFjihcfkwi8zwiaqG3F47iSPzU6OsTPdCE8z76SltfY8iU4Ota4ply3PpKZfvExMZbjiDtmHZXr04g5zZpFICRQMv6vDaY0aJFZAm7ICS41ts93vJSUHoKfyn7k3qEOI2IZmca2aMVVAO2x69V6cesIG4ECq',
            ),
            62 =>
            array (
                'hr_employee_id' => 63,
                'auth_code' => 813,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'sIcrIb1v5WWRJTjhqZGyvfo5IdTGlBVuWmGURbEoASn2FFck6B0oYO7JGn3ldRPdGpbV25BAXIf81YnIXDSVSFWcYNfdIxPTk4vFDylApP4T0ICESvFF8T7y4u9PfvrgBLhpKPauVw46MASXvBGIouHfOo8iBhwCuxdgEOBlkot7nAAO3lPI3ro5kWIiH1rO49fDHEm9TLJptmP0LTQE9uMycStKnpp1gyyXpHneTbKgibDfja3foQdVZ4YsJix',
            ),
            63 =>
            array (
                'hr_employee_id' => 64,
                'auth_code' => 812,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'MmObX7q4bwDCMVGIiyJeZ3KmjmbG6gKPHQeam47clc5mrl6HfZ6pC4I3J4u9j6zVTNq1vXB2w4jwmHDGCXUOq6nUoVLk5S0DBQxP93jtFr62AgUQO44eDEDC7h8TCdi4j1GrgIRIz8BnZQsVTccD0Ea7oPlerYzwyX7LEOoStlY1zYOoYK1kzKfFCgzMUmO1745qUElJ3K0wmmoxJBlozVZEbVs4eHsKG2q9evNFY2fOTWrDAYZhyuOwZ5fC4gB',
            ),
            64 =>
            array (
                'hr_employee_id' => 65,
                'auth_code' => 811,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '6ZH0pteZJwgair7DAsT4zBVmx4YPEmVMV57w1zjaryTxWSoxfME8uS51yfhVrlEISECmfCmbleIkzE1MoxxMuKPKKzSlfMQTaQQVgouGyuz177XQLsTx2DVidw89GcIWfUsH8hHH5yMQJZ7nvxTCpLmj5bJGg3neapp5iLA0XrOjZwNaxddy5UaptxmRTAyEEbT9AJWsVH5GuKSC8WxpMPmcbb2Q2R2RHNlGiHZOSCGGa7Di55ecOI9vvHUTl0n',
            ),
            65 =>
            array (
                'hr_employee_id' => 66,
                'auth_code' => 810,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'UxFhtbEcsQsYYMmddpuMXhJU5qXmzP3oTzeNFvpgVOigjm0YQeyxsAyJaWC4xLFYU4csU51ykwpzaOj96YGO5Bd26Jtio64iS6AOUP2wR5C6l4hiZ5y1N4TJYIQW5QfMaPeOVorypcuBmUzXz4U62TPiL5uwzM1h6NDpWOPiI698J9ujDp8nYQ7qgZlHHb921n2P1w1jS567rOY0Wsa0MGKoyiHw6r1qmWTiMl4nD6obf9YNzI0gm1KckKGwwLn',
            ),
            66 =>
            array (
                'hr_employee_id' => 67,
                'auth_code' => 809,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'N6DGtMLE3uYZNYfgbj1Ce20BjdgG6XiJxU4GC2sBaKaDBLmd7ZIpmeUAucPLeZvmgvg22MrU2DKIDxc6jijlIwbM3QH1EhcLPjSUeqaydCgTbjiQZg5fsq31j8Rg8hw6eUEi2Yn9aaxeBPoBnNDq0okMlElbBM2kK7mMldmKQlbGnnVenHtql964PCzoucPNZI05xdO82PwT95FRdwEOJDLSuARBmGrZXJTSnaDm0fKcq3O2Rvm1ab4Zr6fP8pj',
            ),
            67 =>
            array (
                'hr_employee_id' => 68,
                'auth_code' => 808,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'voLOx6ytAIQU6jd4kGpx5VAT1FQ8zScV4hb0xN4SuEua0W6sLQ5MRFyA3OsqlvAStzzIfzooeCOSLpPhvRrmkvCAB5GSROjKP355BOhQcAJ8JbNo0HDaSUqknnhHQHsltVy9aEXEKzOS7LvNE6bdx7mrIyn5CkRPVkMc1CUb6A4FfXe3DiBIhmHhozl7IiX9w8XuQ5Yh63s3y0qnE03tvJSxxNEGc2rqynMUziNp2BSvhSHnuj6S99FP8058QUr',
            ),
            68 =>
            array (
                'hr_employee_id' => 69,
                'auth_code' => 807,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'fmvLuY5zrSboGmdEkXJVpYagJGxe4EGRJnOUl35FUas6SaoKBxjCyKoYYZyB9lkEAgJB2kWSbBzzSNdLE9y5rqAjMTwHiPtt4ns1Bk4b5puLck1XztHvNJl3lDSne1ypnkrzhlRSCcG1aCqgJSLuWvWNXKdxUSE21FMn7oRQaLRCF4WYiK98P05buuvNUqv3dzxxvwuFmvBlGvntrcDV9UD7HUTsXKp4tem1m1M13XdVVpU4gso4K4KGkfjXW6p',
            ),
            69 =>
            array (
                'hr_employee_id' => 70,
                'auth_code' => 806,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'lRURifIspGy8TbP2GHB2VjanJBbTsMMZIuiHgtimOLo6IlJdgMR3Ziew4WiPzRekE9ugY1o6KFiGrYL6yydopWPWBV4X1Ehq6Q2bMRkPnGkMhPdtyguxDHowpoxStMF2ccEicVNhEudRZ2ZUFt1R9xeDeuhuZAfK1kj6A1qFy3uXdOM5XSMKRTpfRQr29QE7ZULL67oyFVRIJPAaJ6VwoW3plxmeIj9ogLF05IWz5jYohWijpbEWMjXXo9XeLwT',
            ),
            70 =>
            array (
                'hr_employee_id' => 71,
                'auth_code' => 805,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'zQdLVMfa4Dxb4wPlTj9p73LLP56633fjyD2jdEa2ZsXNCLdKgjnxcIdTjWQLY6GoMPdH1du7jBd462KoAI4owcGYQghZ70JZAWcm0L8mIh8wqKMkJXNyGO0ckuH9tFYMjVMNaZoeuHGeUjPKkLzj8COwd9NRFQKxADfxt9hGDPZ2tOY7CH96IrXOt5xEKHqzocvhvTRAPKdNwivG99R8UAvw5IsSCCFPdhdlhxgEeXsnvGFQommpVJIhcCvKuZV',
            ),
            71 =>
            array (
                'hr_employee_id' => 72,
                'auth_code' => 804,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'WRhVOcEoQRJs3J7xpmnmI9zOki5WBADOSINFC3oKfal1UnCyers24nNPGdtHHmJiBNlsszTAKTKcq3dFGxdmXzPCDnOOW1pbGrjFsYC1ZUPol66m9jcy9kr6NFkdC1xujoZbJkknQLyjXlGhy31d0UWWgTcD7YQuVmiGmDKEmkEI5Sl6LbXjFUSu3FHop9YXjus62guxaHjBOW0EoMWA3ECSwr6SXNyY3pc6g2x0t2VbpHJPw5r5c4spMaiJCAz',
            ),
            72 =>
            array (
                'hr_employee_id' => 73,
                'auth_code' => 803,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'aRp1td5ERfN9Fy3hhFDiutyeDzlPMBkcAwmCWigvSe2apQBgES6eMui43eLXJ1aPEodbOvoJgq7yO7W4UOb03cUuYC22FNtYmlihELLEMbqFqJQuej7Tx3jha6W1u301YGv8zu2z440ddrSEMs5hyGyAEaQ44rXw7541cbzcFNJ9Hk0TCs3Yj9WwxZnFe9JhEgI5XpkyTyCWxPfONelrEGYPranLgeuYvGj4RpH9MOqvrNxtZhdX6zLF2cUc4Yl',
            ),
            73 =>
            array (
                'hr_employee_id' => 74,
                'auth_code' => 802,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'd7H3MArWEzoDT5Bn5vHyUVh7tCflwmA2KRVxW3qaMe46AUnOmMOuC397eyfPXJFmQVbab3rwZGqtKEw9ck47lisCWjiNq0v2qe77zdsUrsFA2AIG3KFn0f0zRrsAy9UCWXovGRnURW4k8AGhSRUPNSLDpGCgg9rpuIWXnJmxrHifJIxZ6yE0WTXjOAhiYe7fa6eqPsdVkAWC8eYgq3PvdOTUsrLJd8uGesnWWXW7pblE8ArNKybDFUTNnoIH1I6',
            ),
            74 =>
            array (
                'hr_employee_id' => 75,
                'auth_code' => 801,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'hnKOTsnC3yzXkF7D7zmAZHf0PoQKRy1vcs2pX9EyS7qUmQHweFAOYCquE71xwK3Aa1JKjBDUYFF23Y2w3f9O3a2dYoT3wx949Fv2SZ82Y48TIkRLW3TiLRx3AEXysBXv89Dqt7PhOYukogfWpuUatqkcalIHJum4gj1e6w374FXehGLiPnKPP5YqsFrhyKyFRY6XEVXShTqpaHs49Qs9G9isfHMvXZEquqTgu63yRp7G5DdmTBIjZ5c1ZLnvZ2y',
            ),
            75 =>
            array (
                'hr_employee_id' => 76,
                'auth_code' => 800,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'bb1jsckFfiHUem8Y12U3TfToClHRFp8ekdKBwxV9UbRUrfxKhhtsMmt3acoHnPVCtxpXWDoxlHtnZbz2wCta0p2h1FGrPi008fEH7wco7upm2RxpI8SOGWgHcY13nSE9XJrveoSwoHU5ioLWXuAGFGT4rbaPV5mtkmGKDG2tRFsEm9fft5wDMfOc4NvEXhFZQFGfnSeuMRWuuV5sYv0yGrQlFuGvCqzKYTD4OEH9lThPM589P2ctHHw77OcZNXj',
            ),
            76 =>
            array (
                'hr_employee_id' => 77,
                'auth_code' => 799,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'ousIHNSAOFhPhLdgrVfwGKnf3s0cOmP2i1yWcQWJVXfJocKLsttkprKa5zrfQRIFJiFmFFtHR6IlKCE9xjMoaL2ZMyM7n4IskRpB2fwZCrqfexmLdrTYm1zUqbSir9KPfbCHgJz5HlvDS3slWB7ldrTU7UFTWeoTbd2WGG409CNxbHk5YpyiH7rINtqaNFm4rge983gbxKFTaTELSKL2LQ8PUk9w58aT2zruHLtMYHrYm5QwldMUhvXv7aUSkNN',
            ),
            77 =>
            array (
                'hr_employee_id' => 78,
                'auth_code' => 798,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'f7KpZvmLfYLGr9LJTpOljgsJfUx5EpMdEu82iR6xFC9ueSdcI6u8pBS4lClWlbRyNWXrg42pTNc5GnA0gjNojWQYcfXgYHcg054wCCJRPT7Ptsy7148Lxb3DjUYlYH2w7UVgKMOVwNoiJzIISycI4VJtNe4IUVHO9E1VaEkx09bkQU7GA7fOipyxCtCEV4HQuUamTfAcQYwM7VtJirrEY7Trj7x4ONZhiW1NV92rHt1lNg5IGw94M2Dld09g9Yj',
            ),
            78 =>
            array (
                'hr_employee_id' => 79,
                'auth_code' => 797,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'e7iNFGwT5OCqqdlKrXtxxaS9o3RZkfrey0Bk70IV6uu8hMhbSKIQu4U60UOrhVZFF3YnolaLyWzqBffAVmdv9MvCrHzZpFGhactH5r8lZ83PahZMLUx024WMAZNxGHZ0tT7d7YIkSEWZL8KzeR8vcjaAV3WmVFYPrdOfHF9Bqo1icoD3zc7d8oaoXyxqPfADxdg43b851nrJZVQbSsoayRAV4eYE06rNRFyPEUELj9iycTQAHxeNruHZvqiPTkz',
            ),
            79 =>
            array (
                'hr_employee_id' => 80,
                'auth_code' => 796,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'sk20X6kFB0HnOvcjfeGNltEqN8BlZzfZqI0RrmolnXnRSpKdqO08B6KCgWSrVfM0xYgA976fVJKmBjYO5HPyimlBjxKg4jmrtiBsCk6jtpazKQbJXWbs3KxI9cwLMS0wTSgIXQJrhGAkD4BbPXQyeZquKJ3kSnY2MRN0jXA7R92DFmLRGIrhUbZBML0HA7W2zHyQoRr8LcJXNgR87vCVLvMzhLUPKkB34XsXAHk6hewUoGYX2cxgCvBTkcDKoCI',
            ),
            80 =>
            array (
                'hr_employee_id' => 81,
                'auth_code' => 795,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'E4E7G0LyFeeXK5baOsspeCVQOgFGLbrzdBTHPWzN846ZNbN0ltkNzau8Nbo5NaZYmFL5QBUTXdRyzuToDlImZQFMm0f8DaFU7s4wqgvAmXNAn3t1xeyilU3pqtqXplqunE2X84f9SYTKBOtFzDdTxSXXl9BzEcCsJTHZe1DV8QzAdQHtdM7EhAe6Uq55mssminejHdhC1SLu1uQ3zhYayFIjCZWy2JYgJnKNfnmBLvz2rTDzNlZ77GHlUytsoce',
            ),
            81 =>
            array (
                'hr_employee_id' => 82,
                'auth_code' => 794,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'VjsoqmXQeaZVrpIlBLNUUQQCgl02hx29eqALyiJEdTm9d6z0UQJIgzMCmIRLzHkqRUqkrtIYch5mviJJwLrGY566ObFVoMHSd4GQ7QTd6Mtcoc3g8xRvStQAHaXVg1Sbaqmpo5DzU2O3T2AnCrp7KHnt9Bm5bhQqjnyUUAlWNYHbY4USumaJFRET2Q7dpmNcGQP5Osjg7sahGxRAleyjFAqqrVj6poBVKtNGQD8wAlBXV3xgxw8MQVR3yVMhyFN',
            ),
            82 =>
            array (
                'hr_employee_id' => 83,
                'auth_code' => 793,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '1vvoGpUdH1zFfmZYrloLg8Z6dKQNQiikWHlgeskH1bNevEeUsrCSzZb72SWG0YsDd9IqSyewwdoDWyNBeIxZQyUjeyFzCkZNkIYVyB91IQBWIjXjZiQbADTztf1g8uHw4vd9Q9NxZEfgsQPNiNrKYo1QP1oZ9S9UeVXVbsMVPsBx8tbIpLbcVBoO3YCFdrmyaiIU5doj30YpTazgjUaardPKECocxxKkeXoP3iQp6EhNV8Tg2koJA3m1wS4pV9h',
            ),
            83 =>
            array (
                'hr_employee_id' => 84,
                'auth_code' => 792,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'yNFugRvQfQwgd5SyV3OI0lF0dLkWzVQYGOjgbvYrAQbZwehDZc89sQ2LzYrpKnYC1v8D0bMa4lEnB5KEQOSko17KYUZoNFNEeKk1wPVIMhKoBRWeTsHt6piUw0je8Cg7d7pARoStBwsEqIeHdSnuKgONlsLUWqwHk2fnYQJRrE7E9r1NbXnzMLbtlWtRGzQ1IzszKXQFojHPwz8lEMxSv9R6EqMa35bTqEGdplXSnH1oVfaDDC3I4tbluLFtNdx',
            ),
            84 =>
            array (
                'hr_employee_id' => 85,
                'auth_code' => 791,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'xE4lwvEBBzvc6la4KhijZDNoYjjO4ZMnDg7EF4nPwK3RtoDYtpAFlsvaBuJsp8Ju580H7v6pA7Uk1y5TFcW6QUFOzTs8RkpfjpjCrQpiVP27VN1jVkdGc6gk14ExZ7g4k42782BtQmtX7xVHwQfZL05PvDT0Q3P5qFjCQYRacLiTc5RjvNU54jxBIqzVxZEHWPJVp7mBf9NR6UlW3pW33SzQngM9dVrHbS7JxCDs6wi3qmfyB06rSNx26I8QSwY',
            ),
            85 =>
            array (
                'hr_employee_id' => 86,
                'auth_code' => 790,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'eN4oTjPK3v5jQ5fHu40ZpMUxgstFycsvLYHx2t6xCKF3SYLWsle6QSSYzEyeTaq1FOJRTJO20yDfCAZ6LBJyHJLvjazSQzgn2hFp5ki0KRc77ZFEBRIi868oSckPHCUqowVRX9gxWnsfk70vfcpLDLngAxqCMpiy3Smg3rKsZoeIzfRFXa7pf3Cb8CAVeSwkrxrmVEZGlsGdfwl94MMDLXWQo17qLzG1CP6u8TaYKGm4OJL2psBrIOB4oiMiHSO',
            ),
            86 =>
            array (
                'hr_employee_id' => 87,
                'auth_code' => 789,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'Em06SYGrA3rYfOAntNxvLWUhN0w2lFRd467xgVGZ9iCC1RSkgyMrezY0UidOwn1s7TfUaf77K1ljTLEZJqqilpM32indI1hfYeXUgMG8ChRc7p94R8oAYH40tb6TdNOSbj2yNVMQWf7uA4D8Mo9m2Dxy67WyFeTAe9WLc2AqqYHWuzkx1jzjrSGt9PvyC0aUvB8ZHrQcsOgOmFE6btm3wYgaGKDQnNnFBpe4QZ6LWA0u8ZtdZaQMZBDe4tf2zCd',
            ),
            87 =>
            array (
                'hr_employee_id' => 88,
                'auth_code' => 788,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'gkB8hxvXtW6wsRHyGsDS9JrE6wP7sxqR6dzE1WPrd5zl9U85PkY3bQBwUrfCf1Z6cNm7MxZgSYdvIWCLzaxP0DT483wFUlNpqfFF2ANrBFpbKSgXnhbUa2FjSDgkN2UlvPy3sYtwrpLHGXbVREXyoNHmdtsdVNW7kEAfySExt6pmWpS9uNoRwbbBa2OwxR8xFISk5q9STH1v4yxdpjVF4DGYUGMMU7i1074VUjf6b9h5fXnUbLKzCYsTCRocu4P',
            ),
            88 =>
            array (
                'hr_employee_id' => 89,
                'auth_code' => 787,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'VXI0E6hk6kDLGkHlplENtVyoSwILj4WvHFzQhBintDZW9X6pehxhDyhmHDJducfNA1Swa4qCvH95PXg1DLkKUInHM31Uh32LBvGBpY8s1ePhlWyXtzfQzVV77BOnqhj9829AQ39sGjwx8IbmR6yWXPPp8dBH8xa9dH4aL53qcvJJw5q6by8JM6GIJQWVeMhj67cDMpXYNHegM5oaFi9HcjqpcHYc0lU53nIDt87asJXqXnqBlfd5ZzeJQSl4Vj8',
            ),
            89 =>
            array (
                'hr_employee_id' => 90,
                'auth_code' => 786,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'kKQsU3LG8o6apmwtwiy6y3abxt0DTAVE1sO7PKq77hSICIO2yJTrV1dxwWLm9deIgiKkBpI2IpPS7y89RjdLgUzC52GVrmpKNUmpNmAG0weV0E9FLhdaHItEKmk0P0ARE1dhSMExS2SBLqZfISnQOkAAsPZ28w0qMESGC5eQMBvzHfVzHMoAJOxlpX3xLrdpYoP0tVcwLjF0xRYyBpuiyVuTp0NQzmZnk2D6BVBEOsOg8BxA8iicReF1Cs3ALSA',
            ),
            90 =>
            array (
                'hr_employee_id' => 91,
                'auth_code' => 785,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'PtQkjTXmMbxFQn1SmBN6GHcEbzeYx7OoHKuoMSaUyfkBG9rEzouVDCsJzTZ4AXFosTi50z1bHvesplBb59oqC8GZS947e0tOH1ioXTZ5CdDTk3fVupVIBD37X5W3VbJ3esKq7AHNJd4BbJHhxgFR1PzEZ0rNQZJrh8Er7ms4J6VxJIqzS9cjdfMeQqDAIoiVpueY4iWK9Omi0qkvX17JHilkP5oTBy4PH5mz7g3dQ2zbAqZFg1MuOVVtb9oV6tN',
            ),
            91 =>
            array (
                'hr_employee_id' => 92,
                'auth_code' => 784,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'QLP8XrEkPX2qN8NFjOBm150de4Ci1zgYHoZZ7muhJfPEUdDBNY8YcPfeWCcLXnEoBgtNrs37Vg4XxXbDvM7gU5a1YVoV0lR3EpgnJV3SxJbX2zKy2w1v4UL2HCoaYi7vpCg1TP4kc1kutxsJR66vYvCvZoF6Mc0Cfkijgu4XGYezuJCuyxTRFjTZicpGzMM0hUPBp7LF9972nn7fJM0ds2BNlEXo0a8BUmZEeksMl7eYTnIx1oyO2b6xYMIsCxE',
            ),
            92 =>
            array (
                'hr_employee_id' => 93,
                'auth_code' => 783,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'mjiugrSilUq5m3V152c3nTqIuMOw1FeYEXvF4RgCMStxr0ZMiEpOzRfKTSF0DJuJPOiMM0MOQ8agnkWnMYLwY8k1x35Y7p6184oroubgfwi4o28ymczh2ep6F8i8t5LElGPlTanqFJevp4LDz0SSn9BRPE3F7jBROaLXj1bXdkU8IaPE2JXrMV4zlfZNp45naSHQKwO5nEDZhekDxLmm02zM5hNweyZ4JUfxDevcWN67TpZXRamv4IaydCGsKHF',
            ),
            93 =>
            array (
                'hr_employee_id' => 94,
                'auth_code' => 782,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'Az7U2ZJNRjJr1mdy1Q7g4f8nhEzh7YC5JUKDVmPiVwRVslinH4vroCyrRBTQeV4ko5fmpiiDuX2NUc4IdyM5tEhA0iBjm5AE1UiB9TohgjHvLlA1LXgvwRnlUoqZURsMmhDW1AU1gPsHd9yId5WMZMTMU0DuUqKV6EEwbnowbYzwx59HhUYv6QpJCYshv0FnhRQdOO6ZcEHWeHtNSTyZyKFuTiVvgFcGLT7WERNjYX0NS4HfOyM4j4zrefNxtGk',
            ),
            94 =>
            array (
                'hr_employee_id' => 95,
                'auth_code' => 781,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'kj2TuaPsngzPWskOEF1aMD1myMQwtKcwIE9VYTstr7ctmNOi2GazffqhITkBXghevJxJfZIBUmEVIqg3JzncHP5rVNwviP5PYVqmnfKlKkS7H6wFySJbXRLrQBMV2DBVa4vskexyaVKWAuSjXCUbJMa73BaY897pPLVLfCTjdXJ8tkDaCFpr6CnfUkvFqVHQXDTa51zNqnuKgYRACNOcrjkCirZl5d8KUm3K44OTfMexOFISR8gtfM6JJjoMgA0',
            ),
            95 =>
            array (
                'hr_employee_id' => 96,
                'auth_code' => 780,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'MWU6paY2TzqaA2mmqaVdCm5XLfI1OzCgJbLGR5v9tLZOIxUC4VRq1ILj51s5QF8DRro6c8ffZSn0HNpXvdJDDJPVd8XWeoVSr5kohfugnFfntpUFoTRAIeFRToKhCrjHRoMBLiC0YHqHPQIomVrP176utflOE2MgwPjSlXCFBa2QWGQVcTt6igfAhXPh1HKsDL2RAPLy2Dby9Ae8TdNyy6Tr4r7VUllZoO0iBniei818RHaD6zAbQJOEDekTbbR',
            ),
            96 =>
            array (
                'hr_employee_id' => 97,
                'auth_code' => 779,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'Kk6cz6Y7GjWx3zyqXNMSG8SwGPa5Zl0umht0J86OGkk04dbSnqzF5sHo9AY0iQcJkeEnENzX3tp4cIoHrEKKxvXrqBcroloEKtnLyaafbSLY4hNLsi4Nyljqog9tmoQYAC5MAwLg0vxI0Vn6GvtjbuBwH8WLLduipCnl8MzWUs5182F0uTRecgSEVSQi224lyma2oIog9QC9JarL72DQ8QZ2tGRlJEm1SYm9RuYVtnWzx4p3A33pan1ooBe1T2W',
            ),
            97 =>
            array (
                'hr_employee_id' => 98,
                'auth_code' => 778,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'YANVkfGme2im9ng2vHeU4YXtH4ONZ8BvHaZGpf5bPh3unBXA91sziMBa3UBkqHwkAoZkSRybbFlETFQFAjpmank2uYed8spVqhVqiyc5qvYRdq2hbx67Mk0LbKDJ9yP4Vharq5ihTX9xzu73LMtW4rQANH9Ge34MRq5YGucS7cpl1VX5WMOnmRb4PUd1diJC4r2PHYgZJ1Ye7Zzq0jdx2jC6VkMUIyuaQaArp3pWkulolrMcTTSHZL3VcpJmCHa',
            ),
            98 =>
            array (
                'hr_employee_id' => 99,
                'auth_code' => 777,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'wTIW0RgRJfd87Flc6bu7MxJ96q0GfOM2UiB4ucRCcZNC4BeFjHhxKRpoR1VqQ0YbmYlcPTqvCmcq2OjZLf5ni2K1algf2a3GKUhhy7oMs9aV1T5wrhuHze3tVuCWFM7UPvrUx625fJ0eKkd7nZUpjr4MlcMjIQRV0BSFg3GJqjHL6mjWEU3UfBSnlT7Z3iIhvVHtl57MoekqPAhVABBsZ3zOptLCtwNb3Dn9ZwDCl0WlyAWowrFoXwglduDf2z1',
            ),
            99 =>
            array (
                'hr_employee_id' => 100,
                'auth_code' => 776,
                'bar_auth_code' => '',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => 'Ss9ZDXBkmyemMTfuBzBDYSWqm91NzMmgmTXyWOCutdQezSuWag2Vkc8crdGoGOQqy325Aj9dMtOvvC3ezv9nRtOXa1NuQ54wjiOF4l77wBwPufeoSde4ChCMpIfNfuCn6jyrseOivUPmkWAKN0lFrhOlewgRbehhwB2tDKC3DmZ85SLEFaE62eKEyiMtVZSaepw0Ei9p1jZLa9qjzD3ZqRmEe0163gSVuEyO6ZukZBLFGCYZjQuyIYhnMsNYdq6',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_user')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
