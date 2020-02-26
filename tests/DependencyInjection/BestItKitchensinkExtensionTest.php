<?php

namespace BestIt\KitchensinkBundle\Tests\DependencyInjection;

use BestIt\KitchensinkBundle\DependencyInjection\BestItKitchensinkExtension;
use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class BestItKitchensinkExtensionTest
 *
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 */
class BestItKitchensinkExtensionTest extends TestCase
{
    /**
     * Test container with all values
     *
     * @throws Exception Unknown errors
     *
     * @return void
     */
    public function testContainer()
    {
        $extension = new BestItKitchensinkExtension();
        $container = new ContainerBuilder();

        $extension->load(
            [
                [
                    'template' => $template = uniqid(),
                    'data_provider' => $provider = uniqid(),
                    'template_engine' => $engine = uniqid(),
                ]
            ],
            $container
        );

        static::assertSame($template, $container->getParameter('best_it_kitchensink.template'));
        static::assertTrue($container->hasAlias('best_it_kitchensink.template_engine'));
        static::assertTrue($container->hasAlias('best_it_kitchensink.data_provider'));
    }

    /**
     * Test missing data provider
     *
     * @throws Exception Unknown errors
     *
     * @return void
     */
    public function testMissingProvider()
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessageRegExp('/data_provider/');

        $extension = new BestItKitchensinkExtension();
        $container = new ContainerBuilder();

        $extension->load(
            [
                [
                    'template' => $template = uniqid(),
                    'template_engine' => $engine = uniqid(),
                ]
            ],
            $container
        );
    }
}
