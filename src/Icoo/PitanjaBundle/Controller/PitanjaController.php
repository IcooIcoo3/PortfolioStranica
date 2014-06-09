<?php

namespace Icoo\PitanjaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class PitanjaController extends ContainerAware
{
    public function pitanjaAction() {
    	$templating = $this->container->get('templating');

        return $templating->renderResponse('IcooPitanjaBundle:Pitanja:pitanja.html.twig');
    }
}
