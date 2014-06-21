<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 19.06.14.
 * Time: 13:30
 */

namespace Icoo\CommonBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Icoo\CommonBundle\CustomPhp\ProjectInfoTranslator;

class ProjectInfoController extends ContainerAware
{
    public function infoAction() {
        $request = $this->container->get('request');
        if(false === $request->isXmlHttpRequest()) {
            //throw new NotFoundHttpException();
        }

        $projectInfo = ProjectInfoTranslator::init($request->getLocale())->getProjectInfo();
        $encodedResponse = json_encode($projectInfo, JSON_UNESCAPED_SLASHES);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setProtocolVersion('1.1');
        $response->setStatusCode(200, 'OK');
        $response->setContent($encodedResponse);

        return $response;
    }
} 