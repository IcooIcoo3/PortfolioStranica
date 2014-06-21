<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 11.06.14.
 * Time: 10:04
 */

namespace Icoo\CommonBundle\CustomPhp;

use Symfony\Component\Translation\TranslatorInterface;

class Translator
{
    private static $inst;

    private $translator;
    private $translated = array(
        'nav1' => false,
        'nav2' => false,
        'nav3' => false,
        'nav4' => false,
        'nav5' => false,
        'nav6' => false,

        'naslov_upita' => false,
        'ime' => false,
        'ime_placeholder' => false,
        'email' => false,
        'email_placeholder' => false,
        'upit' => false,
        'upit_placeholder' => false,
        'upit_submit' => false,

        'ProjectInfo' => false,

        'pitanje_1_pitanje' => false,
        'pitanje_1_odgovor' => false,
    );

    public static function init(TranslatorInterface $translator) {
        return (self::$inst instanceof Translator) ? self::$inst : (self::$inst = new self($translator));
    }

    private function __construct(TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    public function basicTranslation() {
        $this->navigacija();

        return $this;
    }

    private function navigacija() {
        $this->translated['nav1'] = $this->translator->trans('Naslovna');
        $this->translated['nav2'] = $this->translator->trans('Što radimo');
        $this->translated['nav3'] = $this->translator->trans('Projekti');
        $this->translated['nav4'] = $this->translator->trans('Web fotografija');
        $this->translated['nav5'] = $this->translator->trans('Što je potrebno za projekt');
        $this->translated['nav6'] = $this->translator->trans('Najčešća pitanja');
    }

    public function upit() {
        $this->translated['naslov_upita'] = $this->translator->trans('Pošaljite upit');
        $this->translated['ime'] = $this->translator->trans('Ime');
        $this->translated['ime_placeholder'] = $this->translator->trans('ime-placeholder');
        $this->translated['email'] = $this->translator->trans('Email');
        $this->translated['email_placeholder'] = $this->translator->trans('email-placeholder');
        $this->translated['upit'] = $this->translator->trans('Upit?');
        $this->translated['upit_placeholder'] = $this->translator->trans('upit-placeholder');
        $this->translated['upit_submit'] = $this->translator->trans('upit-submit');

        return $this;
    }

    public function infoProjekta($index) {
        $this->translated['ProjectInfo'] = $this->translator->trans($index);
        return $this;
    }

    public function pitanja() {
        $this->translated['pitanje_1_pitanje'] = $this->translator->trans('pitanje-1-pitanje');
        $this->translated['pitanje_1_odgovor'] = $this->translator->trans('pitanje-1-odgovor');

        return $this;
    }

    public function getSpecificTranslation($key) {
        if(array_key_exists($key, $this->translated)) {
            return $this->translated[$key];
        }

        return 'Prijevod izostao. Ispričavamo se';
    }

    public function getTranslated() {
        return $this->translated;
    }
} 