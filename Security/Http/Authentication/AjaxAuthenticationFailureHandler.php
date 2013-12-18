<?php

namespace Divi\AjaxLoginBundle\Security\Http\Authentication;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\HttpUtils;

/**
 * @author Sylvain Lorinet <sylvain.lorinet@gmail.com>
 */
class AjaxAuthenticationFailureHandler extends DefaultAuthenticationFailureHandler
{
    /**
     * @var mixed
     */
    private $translator;

    /**
     * @param \Symfony\Component\HttpKernel\HttpKernelInterface $httpKernel
     * @param \Symfony\Component\Security\Http\HttpUtils        $httpUtils
     * @param array                                             $options
     * @param \Psr\Log\LoggerInterface                          $logger
     * @param mixed                                             $translator
     */
    public function __construct(HttpKernelInterface $httpKernel, HttpUtils $httpUtils, array $options, LoggerInterface $logger = null, $translator = null)
    {
        parent::__construct($httpKernel, $httpUtils, $options, $logger);
        
        $this->translator = $translator;
    }

    /**
    * {@inheritDoc}
    */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(array(
                'has_error'	=> true,
                'error'     => $this->translator->trans($exception->getMessage())
            ));
        }
        
        return parent::onAuthenticationFailure($request, $exception);
    }
}
