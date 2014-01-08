<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 1/6/14
 * Time: 5:01 PM
 */

namespace smmoosavi\util;

use IntlDateFormatter;

class Localization
{
    function __construct($locale = null, $calendar = null, $timezone = null)
    {
        $this->local = $locale;
        $this->calendar = $calendar;
        $this->timezone = $timezone;
        $calendar_type = IntlDateFormatter::GREGORIAN;
        $this->numberFormatter = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
        if ($locale) {
            if ($calendar) {
                $locale = $locale . '@calendar=' . $calendar;
            }
            if (strpos($locale, '@') !== false) {
                $calendar_type = IntlDateFormatter::TRADITIONAL;
            }
        }
        $this->dateFormatter = new \IntlDateFormatter($locale, \IntlDateFormatter::FULL,
            \IntlDateFormatter::FULL, $timezone, $calendar_type);
    }

    function lFormat($date, $pattern)
    {
        if ($date instanceof \DateTime) {
            $date = $date->getTimestamp();
        }
        $this->dateFormatter->setPattern($pattern);
        return $this->dateFormatter->format($date);
    }

    function lDate($date, $pattern = null)
    {
        if (is_null($pattern)) {
            $pattern = 'EEEE d MMMM y';
        }
        return $this->lFormat($date, $pattern);
    }

    function lTime($date, $pattern = null)
    {
        if (is_null($pattern)) {
            $pattern = 'HH:mm:ss';
        }
        return $this->lFormat($date, $pattern);
    }

    function lDateTime($date, $pattern = null)
    {
        if (is_null($pattern)) {
            $pattern = 'yyyy/MM/dd HH:mm';
        }
        return $this->lFormat($date, $pattern);
    }

    /**
     * @param int $num
     * @param int|null $type
     * @return string
     */
    function lNum($num, $type = null)
    {
        return $this->numberFormatter->format($num, $type);
    }


} 