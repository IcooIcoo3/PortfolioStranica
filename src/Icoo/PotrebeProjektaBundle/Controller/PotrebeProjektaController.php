<?php

namespace Icoo\PotrebeProjektaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use Icoo\CommonBundle\CustomPhp\Translator;

class PotrebeProjektaController extends ContainerAware
{
    public function potrebeProjektaAction() {
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();

        return $templating->renderResponse('IcooPotrebeProjektaBundle:PotrebeProjekta:potrebeProjekta.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
