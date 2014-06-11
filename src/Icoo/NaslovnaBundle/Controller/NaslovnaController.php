<?php

namespace Icoo\NaslovnaBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Icoo\UpitBundle\Entity\UpitEntity;
use Icoo\UpitBundle\Forms\UpitForm;
use Icoo\CommonBundle\CustomPhp\Translator;

class NaslovnaController extends ContainerAware
{
    public function __construct() {
        date_default_timezone_set('Europe/Zagreb');

        /*var_dump(password_hash('korisnik', PASSWORD_BCRYPT, array('salt' => crypt('blues_boy1986'), 'cost' => '10')));
        die();*/
    }

    public function naslovnaAction(Request $request) {

        // osnovni prijevod stranice : navigacija, professional web development i upit
        // da bi koristio druge, potrebno je pozvati metode specifične za određene dijelove stranice
        // basicTranslation() metoda vraća Icoo\CommonBundle\CustomPhp\Translator objekt pa ga se može i dalje upotrebljavat
        $translator = Translator::init($this->container->get('translator'))->basicTranslation();


    	// dependencies
    	$templating = $this->container->get('templating');
    	$formFactory = $this->container->get('form.factory');
        $manager = $this->container->get('doctrine')->getManager();
        $router = $this->container->get('router');

        $upit = new UpitEntity();
    	$builder = $formFactory->createBuilder('form', $upit, array());
        $form = UpitForm::inst($translator)->createForm($builder)->getForm();

    	$form->handleRequest($request);

    	if($form->isValid()) {
            $manager->persist($upit);
            $manager->flush();

            $this->container->get('session')->getFlashBag()->add('poruka-poslana', true);
            return new RedirectResponse($router->generate('icoo_naslovna_route'), 301);
    	}

        return $templating->renderResponse('IcooNaslovnaBundle:Naslovna:Naslovna.html.twig',
        	array(
        		'form' => $form->createView(),
                'translation' => $translator->getTranslated(),
            )
        );
    }
}
