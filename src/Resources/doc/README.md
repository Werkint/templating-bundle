#
\Obmenat\Model\AppKernel::registerBundles
    new \Brander\Bundle\TemplatingBundle\BranderTemplatingBundle()
    
app/config/routing.yml

brander_templating:
  resource: "@BranderTemplatingBundle/Resources/config/routing.yml"
  prefix: "/api"
  options:
    expose: true
    

Router->generate('ajax_templating', ['template' => '@YourBundle/Some/someTemplate.twig'])