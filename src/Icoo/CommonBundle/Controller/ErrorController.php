<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 15.06.14.
 * Time: 20:06
 */

namespace Icoo\CommonBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController;

class ErrorController extends  ExceptionController
{
    public function showAction() {
        die('kreten');
    }
} 