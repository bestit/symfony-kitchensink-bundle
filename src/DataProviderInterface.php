<?php

namespace BestIt\KitchensinkBundle;

/**
 * API to provide the data for the kitchensink.
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 * @version $id$
 */
interface DataProviderInterface
{
    /**
     * Returns an array with template vars (and optional their getters) to fill the kitchensink template.
     * @return array
     */
    public function getTemplateVars(): array;
}
