<?php

if (!function_exists('currentRoute')) {
    function currentRoute($route)
    {
        return Route::currentRouteNamed($route) ? 'menu-item-here' : '';
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return ucfirst(utf8_encode ($date->formatLocalized('%d %B %Y')));
    }
}

if (!function_exists('formatDateHour')) {
    function formatDateHour($date)
    {
        return ucfirst(utf8_encode ($date->formatLocalized('%d %B %Y | %H:%I')));
    }
}
