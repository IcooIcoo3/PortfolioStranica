<?php

namespace Icoo\ProjektiBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class ProjektiController extends ContainerAware
{
    public function projektiAction() {
    	$templating = $this->container->get('templating');

        return $templating->renderResponse('IcooProjektiBundle:Projekti:projekti.html.twig');
    }
}
