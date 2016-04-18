<?php namespace Anomaly\DocumentationModule\Plugin;

use Twig_Error_Syntax;
use Twig_Token;

/**
 * Class CodeTokenParser
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Plugin
 */
class CodeTokenParser extends \Twig_TokenParser
{

    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return CodeTokenNode A Twig_NodeInterface instance
     *
     * @throws Twig_Error_Syntax
     */
    public function parse(Twig_Token $token)
    {
        $line = $token->getLine();

        $stream = $this->parser->getStream();

        $language = $stream->expect(Twig_Token::NAME_TYPE)->getValue();

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $code = $this->parser->subparse([$this, 'end'], true);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new CodeTokenNode(compact('code'), compact('language'), $line, $this->getTag());
    }

    /**
     * Decide if current token marks end of Markdown block.
     *
     * @param \Twig_Token $token
     * @return bool
     */
    public function end(\Twig_Token $token)
    {
        return $token->test('endcode');
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'code';
    }
}
