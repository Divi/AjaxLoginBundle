<?php

namespace Divi\AjaxLoginBundle\Security\Http\Authentication;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;

/**
 * @author Sylvain Lorinet <sylvain.lorinet@gmail.com>
 */
class AjaxAuthenticationFailureHandler extends DefaultAuthenticationFailureHandler
{
	/**
     * {@inheritDoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
		if ($request->isXmlHttpRequest()) {
			$json = array(
				'has_error'	=> true,
				'error'     => $exception->getMessage()
			);

			return new Response(json_encode($json));
		}

		return parent::onAuthenticationFailure($request, $exception);
    }
}
