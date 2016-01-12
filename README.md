[![Code Climate](https://codeclimate.com/github/galmi/xacmlBundle/badges/gpa.svg)](https://codeclimate.com/github/galmi/xacmlBundle)
[![Test Coverage](https://codeclimate.com/github/galmi/xacmlBundle/badges/coverage.svg)](https://codeclimate.com/github/galmi/xacmlBundle/coverage)
[![Build Status](https://travis-ci.org/galmi/xacmlBundle.svg)](https://travis-ci.org/galmi/xacmlBundle)

GalmiXacmlBundle
================

The GalmiXacmlBundle adds support for ABAC (Attribute Based Access Control) based on
eXtensible Access Control Markup Language (XACML) Version 3.0 OASIS Standard.

Features include:

- Policies can be stored via Doctrine ORM
- Unit tested

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require galmi/xacmlbundle "dev-master"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

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
        $bundles = array(
            // ...

            new Galmi\XacmlBundle\GalmiXacmlBundle(),
        );

        // ...
    }

    // ...
}
```

Using with default configuration
================================

With default configuration it is Permit to all resources and actions if it is not denied.

You must determine Resource for each action. You can add Annotation for your actions.

```php

<?php

namespace AppBundle\Controller;

// ...
use Galmi\XacmlBundle\Annotations\XacmlResource;

class CustomerController extends Controller
{
    /**
     * @XacmlResource(entity="AppBundle\Entity\Customer", id="id")
     */
    public function editAction(Request $request)
    {
      // ...
    }
}

```

This annotation determine resource class "AppBundle\Entity\Customer" with identifier key "id"
in request (_GET, _POST).

Customization
=============

Configure Default Decision 
--------------------------

Default decision is determine the result of request if rules was not matched. 
Default value is "Permit". It's mean that user will restrict access to all requests 
if all rules is not match request.
Default decision value allowed "Permit" or "Deny".

```yml
# config/parameters.yml

parameters:
  galmi_xacml.default_decision: Permit
```

If you using xml configuration, you can use constant PERMIT or DENY of class Galmi\Xacml\Decision.

```xml
<!-- config/services.xml -->

<container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services
        http://symfony.com/schema/dic/services/services-1.0.xsd">
    <parameters>
        <parameter key="galmi_xacml.default_decision" type="constant">Galmi\Xacml\Decision::PERMIT</parameter>
    </parameters>
</container
```

Configure Default Combining Algorithm
-------------------------------------

If you have multiple top level Policy sets or Policies, Policy Decision Point must determine 
only one decision "Permit" or "Allow". For this case you can use Combining Algorithm.
Default value is "\Galmi\Xacml\CombiningAlgorithmRegistry::FIRST_APPLICABLE" it means that
first evaluated Policy set or Policy is the result of PDP.

```yml
# config/parameters.yml

parameters:
  galmi_xacml.default_combining_algorithm: "first-applicable"
```

If you using xml configuration, you can use constants of class Galmi\Xacml\CombiningAlgorithmRegistry.

```xml
<!-- config/services.xml -->

<container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services
        http://symfony.com/schema/dic/services/services-1.0.xsd">
    <parameters>
        <parameter key="galmi_xacml.default_combining_algorithm" type="constant">\Galmi\Xacml\CombiningAlgorithmRegistry::FIRST_APPLICABLE</parameter>
    </parameters>
</container
```
