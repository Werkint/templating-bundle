<?php
namespace Brander\Bundle\TemplatingBundle\Controller;

use Brander\Bundle\TemplatingBundle\Exception\TemplateAccessDeniedException;
use Brander\Bundle\TemplatingBundle\Service\AccessChecker;
use Brander\Bundle\TemplatingBundle\Service\TemplateFinder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class TemplateController
{
    /**
     * @var TemplateFinder
     */
    private $finder;
    /**
     * @var AccessChecker
     */
    private $checker;

    /**
     * @param TemplateFinder $finder
     * @param AccessChecker $checker
     */
    public function __construct(TemplateFinder $finder, AccessChecker $checker)
    {
        $this->finder = $finder;
        $this->checker = $checker;
    }

    /**
     * @param $template
     * @return Response
     * @throws TemplateAccessDeniedException
     */
    public function getAction($template)
    {
        if (!$this->checker->isPublic($template)) {
            throw new TemplateAccessDeniedException($template);
        }
        return new JsonResponse($this->finder->find($template));
    }
}
