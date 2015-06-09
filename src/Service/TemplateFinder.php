<?php
namespace Brander\Bundle\TemplatingBundle\Service;

/**
 * TemplateFinder.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class TemplateFinder
{
    /**
     * @var TemplateParser
     */
    private $parser;

    /**
     * @param TemplateParser $parser
     */
    public function __construct(TemplateParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $template e.g. "@YourBundle/Some/someTemplate.twig"
     * @return array [name=> "template name", source => "template source"]
     */
    public function find($template)
    {
        $sources = $this->parser->parse($template);

        $result = [];
        foreach ($sources as $name => $source) {
            $result[] = [
                'name' => $name,
                'source' => $source
            ];
        }
        return $result;
    }
}
