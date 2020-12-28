<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\Today;

class TodayController extends Controller
{

    public function flaite()
    {
        echo "7 DÍAS DESDE HOY<br><br>";
        for($i = 1; $i <= 7; $i++)
        {
            $date = \Carbon\Carbon::now()->addDays($i)->formatLocalized('%A %d de %B de %Y');
            $date = Today::translateToSpanishDay($date);
            $date = Today::translateToSpanishMonth($date);
            echo "$date<br>";

        }
        echo "===================================<br>";
        echo "12 MESES DESDE HOY<br><br>";
        for($i = 1; $i <= 12; $i++)
        {
            $date = \Carbon\Carbon::now()->addMonths($i)->formatLocalized('%A %d de %B de %Y');
            $date = Today::translateToSpanishDay($date);
            $date = Today::translateToSpanishMonth($date);
            echo "$date<br>";

        }
        echo "===================================<br>";
        echo "HOY<br><br>";
        $now = Today::now();
        echo $now;
    }

    public function locale()
    {
        $today = \Carbon\Carbon::now()->formatLocalized('%A %d de %B de %Y');
        $today = ucfirst( mb_convert_encoding($today, 'UTF-8', 'ISO-8859-1') );
        echo $today;
        return '';
    }

}
