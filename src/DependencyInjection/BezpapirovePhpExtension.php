<?php

declare(strict_types=1);

namespace Bezpapirove\BezpapirovePhpBundle\DependencyInjection;

use Bezpapirove\BezpapirovePhpLib\File\FileHandler;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class BezpapirovePhpExtension extends Extension
{
    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(FileHandler::class);
        $definition->replaceArgument(0, $config['file_handler']['base_path']);
    }
}
