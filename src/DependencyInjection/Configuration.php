<?php

declare(strict_types=1);

namespace Bezpapirove\BezpapirovePhpBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bezpapirove_php_bundle');

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('file_handler')
                    ->children()
                        ->scalarNode('base_path')
                            ->defaultValue('%kernel.project_dir%/public/runtime')
                        ->end()
                    ->end()
                ->scalarNode('default_connection')
                    ->defaultValue('default')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
