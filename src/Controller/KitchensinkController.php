<?php

namespace BestIt\KitchensinkBundle\Controller;

use BestIt\KitchensinkBundle\DataProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Simple kitchensink controller.
 * @author blange <lange@bestit-online.de>
 * @package BestIt\KitchensinkBundle
 * @subpackage Controller
 * @version $id$
 */
class KitchensinkController extends Controller
{
    /**
     * The data provider.
     * @var DataProviderInterface|void
     */
    private $dataProvider = null;

    /**
     * The template name.
     * @var string
     */
    private $templateName = '';

    /**
     * Returns the data provider.
     * @return DataProviderInterface
     */
    public function getDataProvider(): DataProviderInterface
    {
        if (!$this->dataProvider) {
            $this->setDataProvider($this->container->get('best_it_kitchensink.data_provider'));
        }

        return $this->dataProvider;
    }

    /**
     * Returns the template name.
     * @return string
     */
    public function getTemplateName(): string
    {
        if (!$this->templateName) {
            $this->setTemplateName($this->container->getParameter('best_it_kitchensink.template'));
        }

        return $this->templateName;
    }

    /**
     * Returns the view data from the data provider.
     * @return array
     */
    protected function getViewData(): array
    {
        $dataProvider = $this->getDataProvider();
        $viewData = [];

        foreach ($dataProvider->getTemplateVars() as $key => $value) {
            $withGetter = !is_numeric($key);

            $viewData[!$withGetter ? $value : $key] = !$withGetter
                ? $dataProvider->{'get' . ucfirst($value)}()
                : $dataProvider->$value();
        }
        return $viewData;
    }

    /**
     * Renders the template for the kitchensink.
     * @return Response
     */
    public function indexAction(): Response
    {
        $viewData = $this->getViewData();

        return $this->render($this->getTemplateName(), $viewData);
    }

    /**
     * Sets the data provider.
     * @param DataProviderInterface $dataProvider
     * @return KitchensinkController
     */
    public function setDataProvider(DataProviderInterface $dataProvider): KitchensinkController
    {
        $this->dataProvider = $dataProvider;

        return $this;
    }

    /**
     * Sets the template name.
     * @param string $templateName
     * @return KitchensinkController
     */
    public function setTemplateName(string $templateName): KitchensinkController
    {
        $this->templateName = $templateName;

        return $this;
    }
}
