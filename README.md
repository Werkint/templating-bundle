# Templating

### Deprecated
use twig compile instead; and you can use bower

### Composer

`````
composer require 'werkint/templating-bundle:dev-master'
`````

### Kernel
AppKernel::registerBundles:
`````
        ...
    new \Werkint\Bundle\TemplatingBundle\WerkintTemplatingBundle()
        ...
`````        
        
### Routing

app/config/routing.yml:
`````        
    werkint_templating.:
      resource: "@WerkintTemplatingBundle/Resources/config/routing.yml"
      prefix: "/api"
      options:
        expose: true
`````    

`````
$router->generate('ajax_templating', ['template' => '@YourBundle/Some/someTemplate.twig'])
`````

OR

`````
define([
    'some-module/views/view',
    'werkint-templating/template!@YourBundle/Some/someTemplate.twig'
], function (View, template) {
    'use strict';

    return View.extend({
        'template': template,
    });
});
`````

### JS

`````
bower install template --save
`````

or include web/bundles/werkinttemplating/js/*.js

### Public templates

@YourBundle/Resources/config/templates.yml:
````
parameters:
  your_bundle.public_templates:
    - @@YourBundle/Some/someTemplate.twig
services:
  your_bundle.public_template_provider:
    class: Your\Bundle\SomeBundle\Service\TemplateProvider
    arguments:
      - % your_bundle.public_templates%
    tags:
      - {name: werkint_templating.public_template }
````

Or Werkint\Bundle\TemplatingBundle\Service\TemplateProviderInterface