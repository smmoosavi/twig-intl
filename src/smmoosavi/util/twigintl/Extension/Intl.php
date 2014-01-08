<?php

/*
 * This file is part of Twig.
 *
 * (c) 2010 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace smmoosavi\util\twigintl;

use smmoosavi\util\Localization;

class Extension_Intl extends \Twig_Extension
{

    function __construct($locale = null, $calendar = null, $timezone = null)
    {
        $this->stack = array();
        $this->localization = new Localization($locale, $calendar, $timezone);
    }

    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances
     */
    public function getTokenParsers()
    {
        return array(new \smmoosavi\util\twigintl\TokenParser_Intl());
    }


    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            'lDate' => new \Twig_Filter_Function(array($this, 'lDate')),
            'lTime' => new \Twig_Filter_Function(array($this, 'lTime')),
            'lDateTime' => new \Twig_Filter_Function(array($this, 'lDateTime')),
            'lFormat' => new \Twig_Filter_Function(array($this, 'lFormat')),
            'lNum' => new \Twig_Filter_Function(array($this, 'lNum')),
        );
    }

    public function getFunctions()
    {
        return array(
            'lDate' => new \Twig_Function_Function(array($this, 'lDate')),
            'lTime' => new \Twig_Function_Function(array($this, 'lTime')),
            'lDateTime' => new \Twig_Function_Function(array($this, 'lDateTime')),
            'lFormat' => new \Twig_Function_Function(array($this, 'lFormat')),
            'lNum' => new \Twig_Function_Function(array($this, 'lNum')),
        );
    }

    public function lDate($date, $pattern = null)
    {
        return $this->localization->lDate($date, $pattern);
    }

    public function lTime($date, $pattern = null)
    {
        return $this->localization->lTime($date, $pattern);
    }

    public function lDateTime($date, $pattern = null)
    {
        return $this->localization->lDateTime($date, $pattern);
    }

    public function lFormat($date, $pattern = null)
    {
        return $this->localization->lFormat($date, $pattern);
    }

    function lNum($num, $type = null)
    {
        return $this->localization->lNum($num, $type);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'intl';
    }


    public function pushLocale($locale_str)
    {
        if (empty($locale_str)) {
            $locale_array = array();
        } else {
            $locale_array = explode('@', $locale_str);
        }
        while (count($locale_array) < 3) {
            $locale_array[] = null;
        }
        $locale = $locale_array[0];
        $calendar = $locale_array[1];
        $timezone = $locale_array[2];
        $this->stack[] = $this->localization;
        $this->localization = new Localization($locale, $calendar, $timezone);
    }

    public function popLocale()
    {
        $this->localization = array_pop($this->stack);
    }

    public function setLocale($locale = null, $calendar = null, $timezone = null)
    {
        $this->stack = array();
        $this->localization = new Localization($locale, $calendar, $timezone);
    }
}
