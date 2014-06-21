<?php

namespace Icoo\PotrebeProjektaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use Icoo\CommonBundle\CustomPhp\Translator;

use Icoo\CommonBundle\CustomPhp\LanguageChange;

class PotrebeProjektaController extends ContainerAware
{
    public function potrebeProjektaAction() {
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();

        $router = $this->container->get('router');
        $request = $this->container->get('request');
        $session = $this->container->get('session');
        $locale = $request->getLocale();

        $languageChange = new LanguageChange($locale,$session, $router);
        if($languageChange->isLanguageChanged()) {
            return $languageChange->routeOnChange($request->get('_route'));
        }

        return $templating->renderResponse('IcooPotrebeProjektaBundle:PotrebeProjekta:potrebeProjekta.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
