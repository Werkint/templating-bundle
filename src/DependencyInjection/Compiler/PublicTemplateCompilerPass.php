<?php
namespace Brander\Bundle\TemplatingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * PublicTemplateCompilerPass.
 *
 * Собирает публичные шаблоны
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class PublicTemplateCompilerPass implements
    CompilerPassInterface
{
    const SERVICE = 'brander_templating.access_checker';
    const TAG = 'brander_templating.public_template';

    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(static::SERVICE)) {
            return;
        }

        $definition = $container->getDefinition(self::SERVICE);
        $services = $container->findTaggedServiceIds(self::TAG);
        foreach ($services as $id => $tagAttributes) {
            $definition->addMethodCall(
                'addTemplateProvider', [
                    new Reference($id),
                ]
            );
        }
    }
}
