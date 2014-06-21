<?php

namespace Icoo\PitanjaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Icoo\CommonBundle\CustomPhp\Translator;
use Icoo\CommonBundle\CustomPhp\LanguageChange;

class PitanjaController extends ContainerAware
{
    public function pitanjaAction() {

        /* DEPENDENCIES */
    	$templating = $this->container->get('templating');
        $translator = Translator::init($this->container->get('translator'))->basicTranslation()->pitanja();

        $router = $this->container->get('router');
        $request = $this->container->get('request');
        $session = $this->container->get('session');
        $locale = $request->getLocale();

        $languageChange = new LanguageChange($locale, $session, $router);
        if($languageChange->isLanguageChanged()) {
            return $languageChange->routeOnChange($request->get('_route'));
        }

        return $templating->renderResponse('IcooPitanjaBundle:Pitanja:pitanja.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }

    public function redirectOnLanguageChange(RedirectResponse $response) {
        return $response;
    }
}
