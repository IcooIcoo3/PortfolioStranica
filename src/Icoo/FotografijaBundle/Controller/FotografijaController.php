<?php

namespace Icoo\FotografijaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class FotografijaController extends ContainerAware
{
    public function fotografijaAction() {
    	$templating = $this->container->get('templating');

        return $templating->renderResponse('IcooFotografijaBundle:Fotografija:fotografija.html.twig');
    }
}
