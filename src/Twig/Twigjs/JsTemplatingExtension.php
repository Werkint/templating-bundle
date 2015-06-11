<?php
namespace Werkint\Bundle\TemplatingBundle\Twig\Twigjs;
use Werkint\Bundle\TemplatingBundle\Service\TemplateParser;

/**
 * Основное TWIG-расширение
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class JsTemplatingExtension extends \Twig_Extension
{
    const EXT_NAME = 'js_templating_twig_js';

    /**
     * @var \Twig_Environment
     */
    protected $templating;
    /**
     * @var TwigJsTokenParser
     */
    protected $twigJsTokenParser;

    /**
     * @var TwigJsResultTokenParser
     */
    protected $twigJsResultTokenParser;
    /**
     * @var TemplateParser
     */
    private $templateParser;

    /**
     * @param \Twig_Environment $templating
     * @param TwigJsTokenParser $twigJsTokenParser
     * @param TwigJsResultTokenParser $twigJsResultTokenParser
     * @param TemplateParser $templateParser
     */
    public function __construct(
        \Twig_Environment $templating,
        TwigJsTokenParser $twigJsTokenParser,
        TwigJsResultTokenParser $twigJsResultTokenParser,
        TemplateParser $templateParser
    )
    {
        $this->templating = $templating;
        $this->twigJsTokenParser = $twigJsTokenParser;
        $this->twigJsResultTokenParser = $twigJsResultTokenParser;
        $this->templateParser = $templateParser;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return [
            $this->twigJsTokenParser,
            $this->twigJsResultTokenParser,
        ];
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

            // Инклуды. todo: check import
            preg_match_all('!%\\s*(include|extends|import)\\s*(\'|")?(.+?)(\'|")?\\s+!', $contents, $m);
            $modules = array_merge($modules, $m[3]);

            $out .= '<script type="text/x-twig-template" data-id="' . $name . '">';
            $out .= $contents;
            $out .= '</script>';
            $worked[$name] = $name;
        }

        return $out;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return static::EXT_NAME;
    }
}
