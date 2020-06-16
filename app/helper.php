<?php
/**
 * User: IBionic
 * Date: 11.11.2019
 * Time: 17:35
 */


if (!function_exists('parseMultiLanguageString')) {
    function parseMultiLanguageString($string, $languageKey = null, $tilda = false)
    {
        if (empty($languageKey)) {
            $languageKey = app()->getLocale();
        }
        if (!is_array($string)) {
            $string = json_decode($string, true);
        }

        return isset($string[$languageKey]) ? $string[$languageKey] : ($tilda ? '~' : null);
    }
}

if (!function_exists('parseMonth')) {
    function parseMonth($month)
    {
        if ($month == 1) {
            return trans('Пн');
        }
        if ($month == 2) {
            return trans('Вт');
        }
        if ($month == 3) {
            return trans('Ср');
        }
        if ($month == 4) {
            return trans('Чт');
        }
        if ($month == 5) {
            return trans('Пт');
        }
        if ($month == 6) {
            return trans('Сб');
        }
        if ($month == 7) {
            return trans('Нд');
        }
    }
}

if (!function_exists('parseMonthTrue')) {
    function parseMonthTrue($month)
    {
        if ($month == 1) {
            return 'Січень';
        }
        if ($month == 2) {
            return 'Лютий';
        }
        if ($month == 3) {
            return 'Березень';
        }
        if ($month == 4) {
            return 'Квітень';
        }
        if ($month == 5) {
            return 'Травень';
        }
        if ($month == 6) {
            return 'Червень';
        }
        if ($month == 7) {
            return 'Липень';
        }
        if ($month == 8) {
            return 'Серпень';
        }
        if ($month == 9) {
            return 'Вересень';
        }
        if ($month == 10) {
            return 'Жовтень';
        }
        if ($month == 11) {
            return 'Листопад';
        }
        if ($month == 12) {
            return 'Грудень';
        }
    }
}