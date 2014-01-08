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
class TokenParser_Intl extends \Twig_TokenParser
{
    /**
     *
     * Parses a token and returns a node.
     *
     * @param \Twig_Token $token
     * @return \smmoosavi\util\twigintl\Node_Intl|\Twig_NodeInterface
     * @throws \Twig_Error_Syntax
     */
    public function parse(\Twig_Token $token)
    {
        $value = null;
        $stream = $this->parser->getStream();
        if ($stream->test(\Twig_Token::BLOCK_END_TYPE)) {
        } else {
            $expr = $this->parser->getExpressionParser()->parseExpression();
            if ($expr instanceof \Twig_Node_Expression_Constant) {
                $value = $expr->getAttribute('value');
            } else {
                throw new \Twig_Error_Syntax('An escaping strategy must be a string or a Boolean.', $stream->getCurrent()->getLine(), $stream->getFilename());
            }
        }

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new \smmoosavi\util\twigintl\Node_Intl($value, $body, $this->getTag());
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
