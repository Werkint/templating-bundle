<?php
namespace Werkint\Bundle\TemplatingBundle\Exception;

/**
 * TemplateNotFoundException.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class TemplateNotFoundException extends \Exception
{
    /**
     * @param string $template
     */
    public function __construct($template)
    {
        parent::__construct(sprintf('Template %s not found.', $template));
    }

}
