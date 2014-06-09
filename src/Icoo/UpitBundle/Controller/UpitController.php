<?php

namespace Icoo\UpitBundle\Controller;

use Symfony\Component\Form\FormFactoryInterface;

use Icoo\UpitBundle\Entity\UpitEntity;
use Icoo\UpitBundle\Forms\UpitFormType;

class UpitController
{
	private $formFactory;

	public function __construct(FormFactoryInterface $factory) {
		$this->formFactory = $factory;
	}

    public function getUpitForm() {
    	$form = $this->formFactory->create(new UpitFormType(), array());

    	return $form;
    }
}
