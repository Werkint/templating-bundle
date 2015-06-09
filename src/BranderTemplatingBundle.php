<?php
namespace Brander\Bundle\TemplatingBundle;

use Brander\Bundle\TemplatingBundle\DependencyInjection\Compiler\PublicTemplateCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * BranderTemplatingBundle.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class BranderTemplatingBundle extends Bundle
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
