# bestit/kitchensink-bundle

Helps you create a kitchensink incl. route, template and services.

[![Build Status](https://scrutinizer-ci.com/g/bestit/symfony-kitchensink-bundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bestit/symfony-kitchensink-bundle/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bestit/symfony-kitchensink-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bestit/symfony-kitchensink-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/bestit/symfony-kitchensink-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bestit/symfony-kitchensink-bundle/?branch=master)
## Usage

This bundle provides you with a simple controller (**/kitchensink**) and service structure, to load a template, 
defined through the config, filled with the data from the dataprovider implementing the _DataProviderInterface_ of this
 bundle. 

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require bestit/kitchensink-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        // ...
        
        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new BestIt\KitchensinkBundle\BestItKitchensinkBundle();
        }        

        // ...
    }

    // ...
}
```

### Step 3: Configure the bundle

```yaml
# Default configuration for "BestItKitchensinkBundle"
best_it_kitchensink:

    # Which template should be used the render the kitchensink?
    template:             kitchensink/index.html.twig

    # The data provider service implementing the matching interface.
    data_provider:        ~ # Required
```

### Step 4: Import routing files

```yaml
# routing_dev.yml
best_it_kitchensink:
    resource: "@BestItKitchensinkBundle/resources/config/routing.yml"
```

