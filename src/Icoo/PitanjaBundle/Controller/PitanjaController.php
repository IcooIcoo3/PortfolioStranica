<?php

namespace Icoo\PitanjaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use Icoo\CommonBundle\CustomPhp\Translator;

class PitanjaController extends ContainerAware
{
    public function pitanjaAction() {
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();

        return $templating->renderResponse('IcooPitanjaBundle:Pitanja:pitanja.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
