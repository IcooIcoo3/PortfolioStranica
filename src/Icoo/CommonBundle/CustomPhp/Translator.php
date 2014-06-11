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
        'nav6' => false
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

    public function getTranslated() {
        return $this->translated;
    }
} 