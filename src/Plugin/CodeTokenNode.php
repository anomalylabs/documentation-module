<?php namespace Anomaly\DocumentationModule\Plugin;

use Twig_Compiler;

/**
 * Class CodeTokenNode
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Plugin
 */
class CodeTokenNode extends \Twig_Node
{

    /**
     * Compile the node.
     *
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('echo "<pre>";')
            ->write('echo "<code class=\"language-' . $this->getAttribute('language') . '\">";')
            ->subcompile($this->getNode('code'))
            ->write('echo "</code>";')
            ->write('echo "</pre>";');
    }
}
