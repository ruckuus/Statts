<?php

namespace Statts\Bundle\CommonBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SystemController extends Controller
{
    /**
     * Get host system information.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Get host system information.",
     * )
     */
    public function indexAction()
    {
      $facter = $this->get('statts_system_fact');
      $info = $facter->getFacts();
      $status = 'NOK';
      if (count($info) > 1) {
        $status = 'OK';
      }
      return new JsonResponse(array( "status" => $status, "info" => $info ));
    }
}
