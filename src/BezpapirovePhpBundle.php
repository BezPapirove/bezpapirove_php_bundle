<?php

declare(strict_types=1);

namespace Bezpapirove\BezpapirovePhpBundle;

use Bezpapirove\BezpapirovePhpLib\File\FileHandler;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class BezpapirovePhpBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('file_handler')
                    ->children()
                        ->scalarNode('base_path')
                            ->defaultValue('%kernel.project_dir%/public/runtime')
                        ->end()
                    ->end()
                ->end() // file_handler
            ->end()
        ;
    }

    /**
     * @param array|mixed[] $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // load an XML, PHP or YAML file
        $container->import('../config/services.yaml');

        if ($config['file_handler']['base_path']) {
            $container->services()
                ->get(FileHandler::class)
                    ->arg(0, $config['file_handler']['base_path'])
            ;
        }
    }
}
