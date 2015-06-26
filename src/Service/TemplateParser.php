<?php
namespace Werkint\Bundle\TemplatingBundle\Service;
use Werkint\Bundle\TemplatingBundle\Exception\TemplateNotFoundException;

/**
 * TemplateParser.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class TemplateParser
{
    /**
     * @var \Twig_Environment
     */
    private $templating;

    /**
     * TemplateParser constructor.
     * @param \Twig_Environment $templating
     */
    public function __construct(\Twig_Environment $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param string $template
     * @return array
     * @throws \Werkint\Bundle\TemplatingBundle\Exception\TemplateNotFoundException
     */
    public function parse($template)
    {
        $modules = [$template];
        $worked = [];
        while ($name = array_shift($modules)) {
            if (isset($worked[$name])) {
                continue;
            }

            try {
                $source = $this->templating->getLoader()->getSource($name);
            } catch (\Twig_Error_Loader $exception) {
                throw new TemplateNotFoundException($template);
            }

            // Инклуды
            preg_match_all('!%\\s*(include|extends)\\s*(.+?)\\s+!', $source, $m);
            $m = array_map(function ($name) {
                return substr($name, 1, strlen($name) - 2);
            }, array_filter($m[2], function ($name) {
                return preg_match('!^[\'"].+?[\'"]$!', $name);
            }));
            $modules = array_merge($modules, $m);

            $worked[$name] = $source;
        }
        return $worked;

    }
}
