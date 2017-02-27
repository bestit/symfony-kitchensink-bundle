<?php

namespace BestIt\KitchensinkBundle\Tests;

use BestIt\KitchensinkBundle\DataProviderInterface;

/**
 * Fale class for tests.
 * @author blange <lange@bestit-online.de>
 * @category Tests
 * @package BestIt\KitchensinkBundle
 * @version $id4
 */
class DataProviderFake implements DataProviderInterface
{
    /**
     * Fake direct getter.
     * @return string
     */
    public function bar(): string
    {
        return __METHOD__;
    }

    /**
     * Fake getter method.
     * @return string
     */
    public function getFoobar()
    {
        return __METHOD__;
    }

    /**
     * Fake getter method with snake case.
     * @return string
     */
    public function getFoobarBaz()
    {
        return __METHOD__;
    }

    /**
     * Returns an array with template vars (and optional their getters) to fill the kitchensink template.
     * @return array
     */
    public function getTemplateVars(): array
    {
        return [
            'foo' => 'bar',
            'foobar',
            'foobarBaz'
        ];
    }
}
