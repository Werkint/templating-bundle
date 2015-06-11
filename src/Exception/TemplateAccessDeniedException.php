<?php
namespace Werkint\Bundle\TemplatingBundle\Exception;

/**
 * TemplateAccessDeniedException.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class TemplateAccessDeniedException extends \Exception
{
    /**
     * @param string $template
     */
    public function __construct($template)
    {
        parent::__construct(sprintf('Not enough permission to load template %s', $template));
    }

}
