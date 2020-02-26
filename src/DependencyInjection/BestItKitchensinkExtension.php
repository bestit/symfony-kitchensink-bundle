<?php

namespace BestIt\KitchensinkBundle\DependencyInjection;

use Exception;
use InvalidArgumentException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Loading the bundle.
 *
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 */
class BestItKitchensinkExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws InvalidArgumentException When provided tag is not defined in this extension
     * @throws Exception Unknown errors
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setAlias('best_it_kitchensink.data_provider', $config['data_provider']);
        $container->setAlias('best_it_kitchensink.template_engine', $config['template_engine']);
        $container->setParameter('best_it_kitchensink.template', $config['template']);
    }
}
