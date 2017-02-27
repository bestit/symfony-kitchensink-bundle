<?php

namespace BestIt\KitchensinkBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;


/**
 * Loading the bundle.
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 * @subpackage DependencyInjection
 * @version $id$
 */
class BestItKitchensinkExtension extends Extension
{
    /**
     * Loads a specific configuration.
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setAlias('best_it_kitchensink.data_provider', $config['data_provider']);
        $container->setParameter('best_it_kitchensink.template', $config['template']);
    }
}
