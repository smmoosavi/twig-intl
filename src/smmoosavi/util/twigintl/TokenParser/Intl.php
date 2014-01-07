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
class TokenParser_Trans extends \Twig_TokenParser
{
    /**
     *
     * Parses a token and returns a node.
     *
     * @param \Twig_Token $token
     * @return \Twig_Node_Sandbox|\Twig_NodeInterface
     * @throws \Twig_Error_Syntax
     */
    public function parse(\Twig_Token $token)
    {
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new \smmoosavi\util\twigintl\Node_Trans($body, $token->getLine(), $this->getTag());
    }

    public function decideBlockEnd(\Twig_Token $token)
    {
        return $token->test('endlocale');
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'locale';
    }
}
