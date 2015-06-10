# Templating

### Composer

`````
composer require 'werkint/templating-bundle:dev-master'
`````

### Kernel
AppKernel::registerBundles:
`````
        ...
    new \Brander\Bundle\TemplatingBundle\BranderTemplatingBundle()
        ...
`````        
        
### Routing

app/config/routing.yml:
`````        
    brander_templating:
      resource: "@BranderTemplatingBundle/Resources/config/routing.yml"
      prefix: "/api"
      options:
        expose: true
`````    

`````
$router->generate('ajax_templating', ['template' => '@YourBundle/Some/someTemplate.twig'])
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
      - {name: brander_templating.public_template }
````

Or Brander\Bundle\TemplatingBundle\Service\TemplateProviderInterface