<?php

namespace Icoo\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAware;

class CommonController extends ContainerAware
{
    public function commonAction() {
        // error ako bilo tko tko nije ovlašten pokuša pristupiti ovom controlleru
        $templating = $this->container->get('templating');

        return new Response();
    }
}
