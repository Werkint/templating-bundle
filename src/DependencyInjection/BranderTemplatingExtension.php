<?php
namespace Brander\Bundle\TemplatingBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * BranderTemplatingExtension.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class BranderTemplatingExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configDir = realpath(__DIR__ . '/../Resources/config');

        $loader = new YamlFileLoader(
            $container,
            new FileLocator($configDir)
        );
        $loader->load('services.yml');
        $loader->load('twigjs.yml');
    }
}
