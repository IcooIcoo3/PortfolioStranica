<?php

namespace Icoo\FotografijaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Icoo\CommonBundle\CustomPhp\LanguageChange;

use Icoo\CommonBundle\CustomPhp\Translator;

class FotografijaController extends ContainerAware
{
    public function fotografijaAction() {
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

        return $templating->renderResponse('IcooFotografijaBundle:Fotografija:fotografija.html.twig',
            array(
                'translation' => $translator->getTranslated()
            )
        );
    }
}
