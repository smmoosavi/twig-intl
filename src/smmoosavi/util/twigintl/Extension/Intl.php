<?php

/*
 * This file is part of Twig.
 *
 * (c) 2010 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace smmoosavi\util;

class Twig_Localization extends \Twig_Extension
{

    function __construct($locale = null, $calendar = null, $timezone = null, $pattern = '')
    {
        $this->localization = new Localization($locale, $calendar, $timezone, $pattern);
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            'lDate' => new \Twig_Filter_Function(array($this->localization,'lDate')),
            'lTime' => new \Twig_Filter_Function(array($this->localization,'lTime')),
            'lDateTime' => new \Twig_Filter_Function(array($this->localization,'lDateTime')),
            'lFormat' => new \Twig_Filter_Function(array($this->localization,'lFormat')),
        );
    }

    public function getFunctions()
    {
        return array(
            'lDate' => new \Twig_Function_Function(array($this->localization,'lDate')),
            'lTime' => new \Twig_Function_Function(array($this->localization,'lTime')),
            'lDateTime' => new \Twig_Function_Function(array($this->localization,'lDateTime')),
            'lFormat' => new \Twig_Function_Function(array($this->localization,'lFormat')),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'twig_intl';
    }
}
