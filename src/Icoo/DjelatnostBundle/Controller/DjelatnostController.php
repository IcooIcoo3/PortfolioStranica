<?php

namespace Icoo\DjelatnostBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class DjelatnostController extends ContainerAware
{
    public function indexAction() {
    	$templating = $this->container->get('templating');

        return $templating->renderResponse('IcooDjelatnostBundle:Djelatnost:djelatnost.html.twig');
    }
}
