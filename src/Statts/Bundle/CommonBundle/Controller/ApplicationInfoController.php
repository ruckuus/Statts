<?php

namespace Statts\Bundle\CommonBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApplicationInfoController extends Controller
{
    /**
     * Get host system information.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Get information about appname"
     * )
     */
    public function indexAction($appname)
    {
      $status = 'NOK';
      $info = array();

      return new JsonResponse(array( "status" => $status, "info" => $info ));
    }
}
