<?php
namespace Werkint\Bundle\TemplatingBundle\Service;

/**
 * TemplateProviderInterface.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
interface TemplateProviderInterface
{
    /**
     * @param $template
     * @return bool
     */
    public function hasTemplate($template);
}
