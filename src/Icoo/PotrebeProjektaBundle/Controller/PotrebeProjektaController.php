<?php

namespace Icoo\PotrebeProjektaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class PotrebeProjektaController extends ContainerAware
{
    public function potrebeProjektaAction() {
    	$templating = $this->container->get('templating');

        return $templating->renderResponse('IcooPotrebeProjektaBundle:PotrebeProjekta:potrebeProjekta.html.twig');
    }
}
