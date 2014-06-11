<?php

namespace Icoo\UpitBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;

use Icoo\CommonBundle\CustomPhp\Translator;

class UpitForm
{
    private static $instance;
    private $builder;

    private $translator;

    public static function inst($translator) {
        return (self::$instance instanceof UpitForm) ? self::$instance : (self::$instance = new UpitForm($translator));
    }

    private function __construct(Translator $translator) {
        $this->translator = $translator->upit();
    }

    public function createForm(FormBuilderInterface $builder) {
        $builder
            ->add('ime', 'text', array(
                    'attr' => array(
                            'placeholder' => $this->translator->getSpecificTranslation('ime_placeholder')
                        )
                    )
            )
            ->add('email', 'email', array(
                    'attr' => array(
                            'placeholder' => $this->translator->getSpecificTranslation('email_placeholder')
                        )
                    )
            )
            ->add('upit', 'textarea', array(
                    'attr' => array(
                            'placeholder' => $this->translator->getSpecificTranslation('upit_placeholder')
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

