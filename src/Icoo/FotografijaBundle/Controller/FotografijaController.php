<?php

namespace Icoo\FotografijaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use Icoo\CommonBundle\CustomPhp\Translator;

class FotografijaController extends ContainerAware
{
    public function fotografijaAction() {
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();

        return $templating->renderResponse('IcooFotografijaBundle:Fotografija:fotografija.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
