<?php

namespace Icoo\DjelatnostBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use Icoo\CommonBundle\CustomPhp\Translator;

class DjelatnostController extends ContainerAware
{
    public function indexAction() {
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();

        return $templating->renderResponse('IcooDjelatnostBundle:Djelatnost:djelatnost.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
