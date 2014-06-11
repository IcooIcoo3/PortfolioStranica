<?php

namespace Icoo\ProjektiBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use Icoo\CommonBundle\CustomPhp\Translator;

class ProjektiController extends ContainerAware
{
    public function projektiAction() {
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();

        return $templating->renderResponse('IcooProjektiBundle:Projekti:projekti.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
