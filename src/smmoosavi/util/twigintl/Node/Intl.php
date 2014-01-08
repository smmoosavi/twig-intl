<?php

/*
 * This file is part of Twig.
 *
 * (c) 2010 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents a trans node.
 *
 * @package    twig
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
namespace smmoosavi\util\twigintl;
class Node_Intl extends \Twig_Node
{
    public function __construct($locale, \Twig_NodeInterface $body, $lineno, $tag = null)
    {
        parent::__construct(array('body' => $body), array('locale' => $locale), $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param \Twig_Compiler $compiler
     * @internal param \smmoosavi\util\twigintl\A $Twig_Compiler Twig_Compiler instance
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $locale = $this->getAttribute('locale');
        if(is_null($locale)){
            $locale = 'null';
        }else{
            $locale = str_replace("\'", "", $locale);
            $locale = str_replace("\\", "", $locale);
            $locale = "'$locale'";
        }

        $compiler
            ->addDebugInfo($this)
            ->write("\$intl = \$this->env->getExtension('intl');\n")
            ->write("\$locale = $locale;\n")
            ->write("\$intl->pushLocale(\$locale);\n")
            ->subcompile($this->getNode('body'))
            ->write("\$intl->popLocale();\n");
    }
}
