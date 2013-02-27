<?php

namespace Divi\AjaxLoginBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

/**
 * @author Sylvain Lorinet <sylvain.lorinet@gmail.com>
 */
class AjaxFormLoginFactory extends FormLoginFactory
{
	/**
	 * @return string
	 */
	public function getKey()
	{
		return 'ajax-form-login';
	}

	/**
	 * If you want to make a success handler with injected parameters (like provider key),<br />
	 * create a service named "security.authentication.success_handler.your_firewall_name.ajax_form_login"<br />
	 * where "your_firewall_name" is like "secured_area" in Symfony Sandbox example.
	 *
	 * @param ContainerInterface $container
	 * @param int				 $id
	 * @param array				 $config
	 *
	 * @return string
	 */
	protected function createAuthenticationSuccessHandler($container, $id, $config)
	{
		if (isset($config['success_handler'])) {
			return $config['success_handler'];
		}

		$successHandlerId = 'security.authentication.success_handler.' . $id . '.'.str_replace('-', '_', $this->getKey());
		$successHandler   = $container->setDefinition($successHandlerId, new DefinitionDecorator('divi.ajax_login.ajax_athentication_success_handler'));

		$successHandler->replaceArgument(1, array_intersect_key($config, $this->defaultSuccessHandlerOptions));
		$successHandler->addMethodCall('setProviderKey', array($id));

		return $successHandlerId;
	}

	/**
	 * If you want to make a failure handler with injected parameters (like provider key),<br />
	 * create a service named "security.authentication.failure_handler.your_firewall_name.ajax_form_login"<br />
	 * where "your_firewall_name" is like "secured_area" in Symfony Sandbox example.
	 *
	 * @param ContainerInterface $container
	 * @param int				 $id
	 * @param array				 $config
	 *
	 * @return string
	 */
	protected function createAuthenticationFailureHandler($container, $id, $config)
	{
		if (isset($config['failure_handler'])) {
			return $config['failure_handler'];
		}

		$id = 'security.authentication.failure_handler.' . $id . '.'.str_replace('-', '_', $this->getKey());
		$failureHandler = $container->setDefinition($id, new DefinitionDecorator('divi.ajax_login.ajax_athentication_failure_handler'));

		$failureHandler->replaceArgument(2, array_intersect_key($config, $this->defaultFailureHandlerOptions));

		return $id;
	}
}