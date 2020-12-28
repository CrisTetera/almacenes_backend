<?php

namespace App\Helpers;

class Today
{

    public static function now()
    {
        $now = ucfirst( \Carbon\Carbon::now()->formatLocalized('%A %d de %B de %Y') );
        $now = self::translateToSpanishDay($now);
        $now = self::translateToSpanishMonth($now);
        return $now;
    }

    /**
     * Corrección flaite para traducir de inglés a español
     * (Temporal hasta que se solucione el 'locale' del server)
     *
     * @return void
     */
    public static function translateToSpanishDay(string $date) : string
    {
        return str_replace([
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ], [
            'Lunes',
            'Martes',
            'Miércoles',
            'Jueves',
            'Viernes',
            'Sábado',
            'Domingo'
        ], $date);
    }

    /**
     * Corrección flaite para traducir de inglés a español
     * (Temporal hasta que se solucione el 'locale' del server)
     *
     * @return void
     */
    public static function translateToSpanishMonth(string $date) : string
    {
        return str_replace([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ], [
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre',
        ], $date);
    }


}
