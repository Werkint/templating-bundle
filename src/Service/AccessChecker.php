<?php
namespace Brander\Bundle\TemplatingBundle\Service;

/**
 * AccessChecker.
 *
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class AccessChecker
{
    /**
     * @var TemplateProviderInterface[]
     */
    protected $providers = [];

    /**
     * @param TemplateProviderInterface $provider
     */
    public function addTemplateProvider(TemplateProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    /**
     * @param string $template
     * @return bool
     */
    public function isPublic($template)
    {
        foreach ($this->providers as $provider) {
            if ($provider->hasTemplate($template)) {
                return true;
            }
        }
        return false;
    }
}
