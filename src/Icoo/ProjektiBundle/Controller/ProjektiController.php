<?php

namespace Icoo\ProjektiBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Icoo\CommonBundle\CustomPhp\LanguageChange;

use Icoo\CommonBundle\CustomPhp\Translator;

class ProjektiController extends ContainerAware
{
    public function projektiAction() {
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();

        $router = $this->container->get('router');
        $request = $this->container->get('request');
        $session = $this->container->get('session');
        $locale = $request->getLocale();

        $languageChange = new LanguageChange($locale, $session, $router);
        if($languageChange->isLanguageChanged()) {
            return $languageChange->routeOnChange($request->get('_route'));
        }

        return $templating->renderResponse('IcooProjektiBundle:Projekti:projekti.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
