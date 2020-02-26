<?php

namespace BestIt\KitchensinkBundle\Tests\Controller;

use BestIt\KitchensinkBundle\Controller\KitchensinkController;
use BestIt\KitchensinkBundle\Tests\DataProviderFake;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

/**
 * Class KitchensinkControllerTest
 *
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 */
class KitchensinkControllerTest extends TestCase
{
    /**
     * Test index action
     *
     * @return void
     */
    public function testIndexAction()
    {
        $controller = new KitchensinkController(
            $provider = new DataProviderFake(),
            $templateEngine = $this->createMock(Environment::class),
            $templateName = uniqid()
        );

        $templateEngine
            ->expects(static::once())
            ->method('render')
            ->with(
                $templateName,
                [
                    'foo' => 'BestIt\KitchensinkBundle\Tests\DataProviderFake::bar',
                    'foobar' => 'BestIt\KitchensinkBundle\Tests\DataProviderFake::getFoobar',
                    'foobarBaz' => 'BestIt\KitchensinkBundle\Tests\DataProviderFake::getFoobarBaz'
                ]
            )
            ->willReturn($result = uniqid());

        $response = $controller->indexAction();

        static::assertSame($result, $response->getContent());
        static::assertSame(200, $response->getStatusCode());
    }
}
