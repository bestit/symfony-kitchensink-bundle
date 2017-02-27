<?php

namespace BestIt\KitchensinkBundle\Tests;

use BestIt\KitchensinkBundle\BestItKitchensinkBundle;
use BestIt\KitchensinkBundle\DependencyInjection\BestItKitchensinkExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Provides you with a fully build container.
 * @author blange <lange@bestit-online.de>
 * @category Tests
 * @package BestIt\KitchensinkBundle
 * @version $id$
 */
trait ContainerProviderTrait
{
    /**
     * Returns a container builder for this app.
     * @return ContainerBuilder
     */
    private function getContainer(): ContainerBuilder
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.cache_dir', sys_get_temp_dir());
        $container->setParameter('kernel.bundles', ['BestItKitchensinkBundle' => BestItKitchensinkBundle::class]);
        $container->set('bestit_kitchensink.data_provider.test_fake', new DataProviderFake());

        return $container;
    }

    /**
     * Returns the full config.
     * @return array
     */
    private function getFullConfig(): array
    {
        $config = [
            'best_it_kitchensink' => [
                'data_provider' => 'bestit_kitchensink.data_provider.test_fake',
                'template' => 'kitchensink/index.html.twig'
            ]
        ];
        return $config;
    }

    /**
     * Checks the full load of the container.
     * @param array|void $config Inject another config.
     * @return ContainerBuilder
     */
    public function getFullyLoadedContainer($config = null): ContainerBuilder
    {
        if ($config === null) {
            $config = $this->getFullConfig();
        }

        (new BestItKitchensinkExtension())->load($config, $container = $this->getContainer());

        return $container;
    }
}
