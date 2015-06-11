<?php
namespace Werkint\Bundle\TemplatingBundle\Service;

/**
 * TemplateProviderInterface.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class TemplateProvider implements TemplateProviderInterface
{
    /**
     * @var string[]
     */
    private $templates = [];

    /**
     * @param \string[] $templates
     */
    public function __construct(array $templates)
    {
        $this->templates = $templates;
    }

    /**
     * @inheritdoc
     */
    public function hasTemplate($template)
    {
        foreach ($this->templates as $templ) {
            if ($templ === $template) {
                return true;
            }
        }

        return false;
    }
}
