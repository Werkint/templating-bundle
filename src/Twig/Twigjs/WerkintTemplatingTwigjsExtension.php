<?php
namespace Werkint\Bundle\TemplatingBundle\Twig\Twigjs;

use Werkint\Bundle\FrameworkExtraBundle\Twig\AbstractExtension;
use Werkint\Bundle\WebappBundle\Twig\Extension\Template;

/**
 * Основное TWIG-расширение
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class WerkintTemplatingTwigjsExtension extends AbstractExtension
{
    protected $templating;
    protected $kernel;
    protected $twigJsTokenParser;
    protected $twigJsResultTokenParser;

    const EXT_NAME = 'werkint_templating_twigjs';

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
    }

    /**
     * @param \Twig_Environment $templating
     * @param TwigJsTokenParser $twigJsTokenParser
     * @param TwigJsResultTokenParser $twigJsResultTokenParser
     * @throws \Exception
     */
    public function __construct(
        \Twig_Environment $templating, TwigJsTokenParser $twigJsTokenParser, TwigJsResultTokenParser $twigJsResultTokenParser
    )
    {
        $this->templating = $templating;
        $this->twigJsTokenParser = $twigJsTokenParser;
        $this->twigJsResultTokenParser = $twigJsResultTokenParser;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return [$this->twigJsTokenParser, $this->twigJsResultTokenParser,];
    }

    // -- Loading ---------------------------------------
    protected $modules = [];

    /**
     * @param string $name
     */
    public function loadTwigJs($name)
    {
        $this->modules[] = $name;
    }

    /**
     * @return string
     */
    public function loadModules()
    {
        $out = '';
        $modules = $this->modules;
        $worked = [];
        while ($name = array_shift($modules)) {
            if (isset($worked[$name])) {
                continue;
            }
            $contents = $this->templating->getLoader()->getSource($name);
            $template = $this->templating->loadTemplate($name);
            if ($template instanceof Template) {
                $template->processDisplay();
            }
            // Инклуды
            preg_match_all('!%\\s*(include|extends)\\s*(.+?)\\s+!', $contents, $m);
            $m = array_map(function ($name) {
                return substr($name, 1, strlen($name) - 2);
            }, array_filter($m[2], function ($name) {
                return preg_match('!^[\'"].+?[\'"]$!', $name);
            }));
            $modules = array_merge($modules, $m);
            $out .= '<script type="text/x-twig-template" data-id="' . $name . '">';
            $out .= $contents;
            $out .= '</script>';
            $worked[$name] = $name;
        }
        return $out;
    }
}