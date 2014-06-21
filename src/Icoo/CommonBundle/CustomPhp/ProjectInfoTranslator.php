<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 19.06.14.
 * Time: 15:24
 */

namespace Icoo\CommonBundle\CustomPhp;


class ProjectInfoTranslator
{
    private static $inst;

    private $locale;
    private $infoData = array(
        'hr' => array(
            0 => array(
                'naslov' => 'Agencija za pravni promet nekretninama / Republika Hrvatska',
                'lines' => array(
                    'Dizajn',
                    'Izrada CMS sustava',
                    'PHP, HTML5 / CSS3, Javascript (Jquery)',
                    'Font / Arial', 'Promo video - pogledaj',
                    'Održavanje sadržaja  / Ne'
                ),
                'link' => 'http://www.apn.com'
            ),
            1 => array(
                'naslov' => 'Izletište Bara',
                'lines' => array(
                    'Dizajn',
                    'Izrada CMS sustava',
                    'PHP, HTML5 / CSS3, Javascript(Jquery)',
                    'Font / Arial',
                    'Održavanje sadržaja / Ne'
                ),
                'link' => 'http://www.izletiste-bara.hr'
            ),
            2 => array(
                'naslov' => 'Plesni klub Bravo / Zagreb',
                'lines' => array(
                    'Dizajn',
                    'Izrada CMS sustava',
                    'Font / Impact / Arial',
                    'Održavanje sadržaja / Ne'
                ),
                'link' => 'http://www.plesni-klub-bravo.hr'
            ),
            3 => array(
                'naslov' => 'Fino.hr sustav za rezervaciju i predbilježbu svježeg mesa - Eko Mesnica',
                'lines' => array(
                    'Sustav naručivanja',
                    'Ugradnja kartičnog plaćanja',
                    'Obrada narudžbi',
                    'Interna blagajna',
                    'Sustav skladišta',
                    'Sustav proizvoda',
                    'Sustav fiskalizacije',
                    'Sustav računa'
                ),
                'link' => 'http://www.fino.hr'
            ),
            4 => array(
                'naslov' => 'Grad Grubipno Polje / Republika Hrvatska',
                'lines' => array(
                    'Dizajn',
                    'Izrada CMS sustava',
                    'PHP, HTML5 / CSS3, Javascript (Jquery)',
                    'Font / Arial',
                    'Promo video - pogledaj',
                    'Održavanje sadržaja  / Ne'
                ),
                'link' => 'http://www.grubisnopolje.hr'
            ),
            5 => array(
                'naslov' => 'popara / trandler internet support',
                'lines' => array(
                    'Dizajn',
                    'PHP, HTML5 / CSS3, Javascript (Jquery)',
                    'Font / Arial / Futura Md Bt - Licenca',
                    'Promo video - pogledaj',
                    'Održavanje sadržaja  / Da'
                ),
                'link' => 'http://www.popara-trandler.com'
            ),
            6 => array(
                'naslov' => 'Tlocrt društveni web portal',
                'lines' => array(
                    'Dizajn',
                    'Izrada CMS sustava',
                    'Fotografija',
                    'Hosting',
                    'PHP, HTML5 / CSS3, Javascript (Jquery)',
                    'Font / Arial / Futura Md Bt - Licenca',
                    'Promo video - pogledaj',
                    'Održavanje sadržaja  / Da'
                ),
                'link' => 'http://www.tlocrt.hr'
            )
        ),
        'en' => array(
            0 => array(
                'naslov' => 'Realestate agency / Republika Hrvatska',
                'lines' => array(
                    'Design',
                    'Built-in custom CMS system',
                    'PHP, HTML5 / CSS3, Javascript (Jquery)',
                    'Font / Arial', 'Promo video - pogledaj',
                    'Content managment  / No'
                ),
                'link' => 'http://www.apn.com'
            ),
            1 => array(
                'naslov' => 'Vacation resort - Bara',
                'lines' => array(
                    'Design',
                    'Built-in custom CMS system',
                    'PHP, HTML5 / CSS3, Javascript(Jquery)',
                    'Font / Arial',
                    'Content managment / No'
                )
            ),
            2 => array(
                'naslov' => 'Dance club Bravo / Zagreb',
                'lines' => array(
                    'Design',
                    'Built-in custom CMS system',
                    'Font / Impact / Arial',
                    'Content managment / No'
                )
            ),
            3 => array(
                'naslov' => 'Fino.hr preorder and reservations fresh meat system - Eko Mesnica',
                'lines' => array(
                    'Ordering system',
                    'Orders processing',
                    'Pay by credit card',
                    'Internal cach registry',
                    'Warehouse system',
                    'Product system',
                    'Fiscalisation system',
                    'Billing and account system'
                ),
                'link' => 'http://www.fino.hr'
            ),
            4 => array(
                'naslov' => 'City of Grubipno Polje / Republika Hrvatska',
                'lines' => array(
                    'Desigm',
                    'Built-in custom CMS system',
                    'PHP, HTML5 / CSS3, Javascript (Jquery)',
                    'Font / Arial',
                    'Promo video - pogledaj',
                    'Content Managment  / No'
                ),
                'link' => 'http://www.grubisnopolje.hr'
            ),
            5 => array(
                'naslov' => 'popara / trandler internet support',
                'lines' => array(
                    'Design',
                    'PHP, HTML5 / CSS3, Javascript(Jquery)',
                    'Font / Arial / Futura Md Bt - Licenca',
                    'Promo video - watch',
                    'Content managment  / Yes'
                )
            ),
            6 => array(
                'naslov' => 'Tlocrt social web portal',
                'lines' => array(
                    'Desigm',
                    'Built-in custom CMS system',
                    'Photography',
                    'Hosting',
                    'PHP, HTML5 / CSS3, Javascript (Jquery)',
                    'Font / Arial / Futura Md Bt - Licenca',
                    'Promo video - watch',
                    'Content Managment  / Yes'
                ),
                'link' => 'http://www.tlocrt.hr'
            )
        )
    );

    public static function init($locale) {
        return (self::$inst instanceof ProjectInfoTranslator) ? self::$inst : (self::$inst = new self($locale));
    }

    private function __construct($locale) {
        $this->locale = $locale;
    }

    public function getProjectInfo() {
        if( ! array_key_exists($this->locale, $this->infoData)) {
            return 'No data';
        }

        return $this->infoData[$this->locale];
    }
} 