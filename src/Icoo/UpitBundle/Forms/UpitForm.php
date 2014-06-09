<?php

namespace Icoo\UpitBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;

class UpitForm
{
    private static $instance;
    private $builder;

    public static function inst() {
        return (self::$instance instanceof UpitForm) ? self::$instance : (self::$instance = new UpitForm());
    }

    private function __construct() {

    }

    public function createForm(FormBuilderInterface $builder) {
        $builder
            ->add('ime', 'text', array(
                    'attr' => array(
                            'placeholder' => 'Vaše cijenjeno ime'
                        )
                    )
            )
            ->add('email', 'email', array(
                    'attr' => array(
                            'placeholder' => 'Vaša Email adresa'
                        )
                    )
            )
            ->add('upit', 'textarea', array(
                    'attr' => array(
                            'placeholder' => 'Vaš upit ...'
                        )
                    )
            )
            ->add('Posalji', 'submit');

        $this->builder = $builder;
        
        return $this;
    }

    public function getForm() {
        return $this->builder->getForm();
    }
}

