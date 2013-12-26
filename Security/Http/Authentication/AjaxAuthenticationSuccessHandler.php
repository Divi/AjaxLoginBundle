<?php

namespace Divi\AjaxLoginBundle\Security\Http\Authentication;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;

/**
 * @author Sylvain Lorinet <sylvain.lorinet@gmail.com>
 */
class AjaxAuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    /**
     * {@inheritDoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($request->isXmlHttpRequest()) {
            return new Response(json_encode(array(
                'has_error'   => false,
                'username'    => $token->getUser()->getUsername(),
                'target_path' => $this->determineTargetUrl($request)
            )));
        }

        return parent::onAuthenticationSuccess($request, $token);
    }
}
