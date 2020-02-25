<?php

namespace BestIt\KitchensinkBundle\Controller;

use BestIt\KitchensinkBundle\DataProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Simple kitchensink controller.
 *
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 */
class KitchensinkController
{
    /**
     * The data provider.
     *
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * The template engine
     *
     * @var Environment
     */
    private $templateEngine;

    /**
     * The template name.
     *
     * @var string
     */
    private $templateName;

    /**
     * KitchensinkController constructor.
     *
     * @param DataProviderInterface $provider
     * @param Environment $engine
     * @param string $template
     */
    public function __construct(DataProviderInterface $provider, Environment $engine, string $template)
    {
        $this->dataProvider = $provider;
        $this->templateEngine = $engine;
        $this->templateName = $template;
    }

    /**
     * Returns the view data from the data provider.
     *
     * @return array
     */
    private function getViewData(): array
    {
        $viewData = [];

        foreach ($this->dataProvider->getTemplateVars() as $key => $value) {
            $withGetter = !is_numeric($key);

            $viewData[!$withGetter ? $value : $key] = !$withGetter
                ? $this->dataProvider->{'get' . ucfirst($value)}()
                : $this->dataProvider->$value();
        }
        return $viewData;
    }

    /**
     * Renders the template for the kitchensink.
     *
     * @throws LoaderError Error while loading
     * @throws RuntimeError Runtime errors
     * @throws SyntaxError Syntax errors
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return new Response(
            $this->templateEngine->render($this->templateName, $this->getViewData())
        );
    }
}
