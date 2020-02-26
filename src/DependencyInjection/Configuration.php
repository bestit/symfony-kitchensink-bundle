<?php

namespace BestIt\KitchensinkBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for the bundle.
 *
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder('best_it_kitchensink');

        $rootNode = $this->getRootNode($builder, 'best_it_kitchensink');
        $rootNode
            ->children()
                ->scalarNode('template')
                    ->info('Which template should be used the render the kitchensink?')
                    ->defaultValue('kitchensink/index.html.twig')
                ->end()
                ->scalarNode('data_provider')
                    ->info('The data provider service implementing the matching interface.')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('template_engine')
                    ->info('The template engine service id.')
                    ->defaultValue('twig')
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $builder;
    }

    /**
     * BC layer for symfony/config 4.1 and older
     *
     * @param TreeBuilder $treeBuilder
     * @param $name
     *
     * @return ArrayNodeDefinition|NodeDefinition
     */
    private function getRootNode(TreeBuilder $treeBuilder, $name)
    {
        if (!method_exists($treeBuilder, 'getRootNode')) {
            return $treeBuilder->root($name);
        }

        return $treeBuilder->getRootNode();
    }
}
