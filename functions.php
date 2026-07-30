<?php
require_once( __DIR__ . '/functions/autoload.php' );

add_filter('determine_locale', function($locale) {

    if (function_exists('pll_current_language')) {

        return pll_current_language() === 'en'
            ? 'en_GB'
            : 'nl_NL';
    }

    return $locale;
});