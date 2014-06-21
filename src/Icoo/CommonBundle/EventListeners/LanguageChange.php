<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 13.06.14.
 * Time: 18:41
 */

namespace Icoo\CommonBundle\EventListeners;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class LanguageChange
{
    private $cont;
    private $request;

    public function __construct($cont, RequestStack $requestStack) {
        $this->cont = $cont;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function onKernelController(FilterControllerEvent $event) {
        $this->cont->get('session')->remove('previous-locale');

        $session = $this->cont->get('session');
        $locale = $this->request->getLocale();
        $router = $this->cont->get('router');

        $controller = $event->getController();

        if ( ! is_array($controller)) {
            return;
        }

        var_dump($locale);
        if($session->has('prev-locale')) {
            $prevLocale = $session->get('prev-locale');
            var_dump($prevLocale);
            if($prevLocale != $locale) {
                $session->set('prev-locale', $locale);
                $redirectUrl = $router->generate($this->generateWantedRoute($this->request->get('_route'), $locale));
                $controller[0]->redirectOnLanguageChange(new RedirectResponse($redirectUrl));
                return;
            }
        }
        else {
            $session->set('prev-locale', $locale);
            var_dump('Jedanput: ' . $session->get('prev-locale'));
        }
    }

    private function generateWantedRoute($currentRoute, $locale) {
        $route = substr($currentRoute, 0, -3) . '_' . $locale;
        return $route;
    }




} 