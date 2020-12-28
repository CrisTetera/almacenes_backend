<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Blade;


class CustomBladeDirectives
{

    public static function boot()
    {
        // Format Int directive
        Blade::directive('format_int', function($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        // Format Dec directive
        Blade::directive('format_dec', function($expression) {
            return "<?php echo number_format($expression, 2, ',', '.'); ?>";
        });

    }

}
