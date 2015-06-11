<?php
namespace Werkint\Bundle\TemplatingBundle;

use Werkint\Bundle\TemplatingBundle\DependencyInjection\Compiler\PublicTemplateCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * WerkintTemplatingBundle.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class WerkintTemplatingBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new PublicTemplateCompilerPass());

    }
}
