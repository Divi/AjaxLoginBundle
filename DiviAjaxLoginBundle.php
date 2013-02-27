<?php

namespace Divi\AjaxLoginBundle;

use Divi\AjaxLoginBundle\DependencyInjection\Security\Factory\AjaxFormLoginFactory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DiviAjaxLoginBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		// Inject factory into security
		$extension = $container->getExtension('security');
		$extension->addSecurityListenerFactory(new AjaxFormLoginFactory());
	}
}