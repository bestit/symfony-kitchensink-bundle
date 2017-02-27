<?php

namespace BestIt\KitchensinkBundle\Tests\Controller;

use BestIt\KitchensinkBundle\Controller\KitchensinkController;
use BestIt\KitchensinkBundle\DataProviderInterface;
use BestIt\KitchensinkBundle\Tests\ContainerProviderTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class KitchensinkControllerTest
 * @author blange <lange@bestit-online.de>
 * @category Tests
 * @package BestIt\KitchensinkBundle
 * @subpackage Controller
 * @version $id$
 */
class KitchensinkControllerTest extends TestCase
{
    use ContainerProviderTrait;

    /**
     * The used container.
     * @var ContainerBuilder
     */
    private $container = null;

    /**
     * The tested class.
     * @var KitchensinkController
     */
    private $fixture = null;

    /**
     * Sets up the test.
     * @return void
     */
    public function setUp()
    {
        $this->fixture = new KitchensinkController();

        $this->fixture->setContainer($this->container = $this->getFullyLoadedContainer());
    }

    /**
     * Checks if the response can be rendered.
     * @return void
     */
    public function testIndexAction()
    {
        $this->container->set('templating', $mock = static::createMock(EngineInterface::class));

        $mock
            ->method('renderResponse')
            ->with(
                $this->fixture->getTemplateName(),
                [
                    'foo' => 'BestIt\KitchensinkBundle\Tests\DataProviderFake::bar',
                    'foobar' => 'BestIt\KitchensinkBundle\Tests\DataProviderFake::getFoobar',
                    'foobarBaz' => 'BestIt\KitchensinkBundle\Tests\DataProviderFake::getFoobarBaz'
                ]
            )
            ->willReturn($response = static::createMock(Response::class));

        static::assertSame($response, $this->fixture->indexAction());
    }

    /**
     * Checks the getter and setter for the template name.
     * @covers KitchensinkController::getDataProvider()
     * @covers KitchensinkController::setDataProvider()
     * @return void
     */
    public function testSetAndGetDataProvider()
    {
        static::assertInstanceOf(
            DataProviderInterface::class,
            $this->fixture->getDataProvider(),
            'Wrong default return.'
        );

        static::assertSame(
            $this->fixture,
            $this->fixture->setDataProvider($mock = static::createMock(DataProviderInterface::class)),
            'Fluent interface broken.'
        );

        static::assertSame($mock, $this->fixture->getDataProvider(), 'Value not saved.');
    }

    /**
     * Checks the getter and setter for the template name.
     * @covers KitchensinkController::getTemplateName()
     * @covers KitchensinkController::setTemplateName()
     * @return void
     */
    public function testSetAndGetTemplateName()
    {
        static::assertSame('kitchensink/index.html.twig', $this->fixture->getTemplateName(), 'Wrong default return.');

        static::assertSame(
            $this->fixture,
            $this->fixture->setTemplateName($mock = uniqid()),
            'Fluent interface broken.'
        );

        static::assertSame($mock, $this->fixture->getTemplateName(), 'Value not saved.');
    }
}
