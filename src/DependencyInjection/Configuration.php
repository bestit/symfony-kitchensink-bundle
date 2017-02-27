<?php

namespace BestIt\KitchensinkBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for the bundle.
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 * @subpackage DependencyInjection
 * @version $id$
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('best_it_kitchensink')
            ->children()
                ->scalarNode('template')
                    ->info('Which template should be used the render the kitchensink?')
                    ->defaultValue('kitchensink/index.html.twig')
                ->end()
                ->scalarNode('data_provider')
                    ->info('The data provider service implementing the matching interface.')
                    ->isRequired()
                ->end()
            ->end();

        return $builder;
    }
}
