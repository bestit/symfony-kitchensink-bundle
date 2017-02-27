<?php

namespace BestIt\KitchensinkBundle\Tests\DependencyInjection;

use BestIt\KitchensinkBundle\DependencyInjection\BestItKitchensinkExtension;
use BestIt\KitchensinkBundle\Tests\ContainerProviderTrait;
use BestIt\KitchensinkBundle\Tests\DataProviderFake;
use PHPUnit\Framework\TestCase;

/**
 * Class BestItKitchensinkExtensionTest
 * @author blange <lange@bestit-online.de>
 * @category Tests
 * @package BestIt\KitchensinkBundle
 * @subpackage DependencyInjection
 * @version $id$
 */
class BestItKitchensinkExtensionTest extends TestCase
{
    use ContainerProviderTrait;

    /**
     * The used prefix in the bundle.
     * @var string
     */
    const BUNDLE_PREFIX = 'best_it_kitchensink';

    /**
     * Returns some rules for the config value tests.
     * @return array
     */
    public function getConfigValueAssertions(): array
    {
        return [
            // key, wrong value, is required
            ['data_provider', mt_rand(0, 1000), true],
            ['template', null],
        ];
    }

    /**
     * Checks the config value.
     * @dataProvider getConfigValueAssertions
     * @param string $key
     */
    public function testConfigValue(string $key)
    {
        $config = $this->getFullConfig();

        $container = $this->getFullyLoadedContainer($config);

        static::assertTrue(
            $container->hasParameter(self::BUNDLE_PREFIX . '.' . $key),
            'Parameter is missing.'
        );

        static::assertSame(
            $config[self::BUNDLE_PREFIX][$key],
            $container->getParameter(self::BUNDLE_PREFIX . '.' . $key),
            'Value was wrong.'
        );
    }

    /**
     * Checks if the data provider is loaded.
     * @return void
     */
    public function testDataProviderInstance()
    {
        $container = $this->getFullyLoadedContainer();

        static::assertTrue($container->hasAlias(self::BUNDLE_PREFIX . '.data_provider'));
        static::assertInstanceOf(DataProviderFake::class, $container->get(self::BUNDLE_PREFIX . '.data_provider'));
    }

    /**
     * Checks the default value of the template.
     * @covers BestItKitchensinkExtension::load()
     * @covers Configuration::getConfigTreeBuilder()
     * @return void
     */
    public function testTemplateDefaultValue()
    {
        $config = $this->getFullConfig();

        unset($config[self::BUNDLE_PREFIX]['template']);

        $container = $this->getFullyLoadedContainer($config);

        static::assertTrue($container->hasParameter(self::BUNDLE_PREFIX . '.template'));
        static::assertSame('kitchensink/index.html.twig', $container->getParameter(self::BUNDLE_PREFIX . '.template'));
    }
}
