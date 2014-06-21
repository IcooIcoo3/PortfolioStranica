<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 13.06.14.
 * Time: 18:41
 */

namespace Icoo\CommonBundle\CustomPhp;

use Symfony\Component\HttpFoundation\RedirectResponse;

class LanguageChange
{

    private $locale;
    private $session;
    private $router;

    public function __construct($locale, $session, $router) {
        $this->locale = $locale;
        $this->session = $session;
        $this->router = $router;
    }

    public function isLanguageChanged() {
        if($this->session->has('previous-locale')) {
            $prevLocale = $this->session->get('previous-locale');
            if($prevLocale != $this->locale) {
                return true;
            }
        }
        else {
            $this->session->set('previous-locale', $this->locale);
            return false;
        }

        return false;
    }

    public function routeOnChange($currentRoute) {
        $this->session->set('previous-locale', $this->locale);
        return new RedirectResponse($this->router->generate($this->generateWantedRoute($currentRoute)));
    }

    private function generateWantedRoute($currentRoute) {
        $route = substr($currentRoute, 0, -3) . '_' . $this->locale;
        return $route;
    }


} 