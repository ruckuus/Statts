<?php

namespace Statts\Bundle\CommonBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StattsController extends Controller
{
    /**
     * Push data.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Push key => value",
     *  input="Statts\Bundle\CommonBundle\Model\InputType",
     *  output="Symfony\Component\HttpFoundation\JsonResponse"
     * )
     */
     public function pushAction(Request $request)
     {
       $data = $request->request->all();
       $status = ((true === $this->get('statts_data_service')->save($data)) ? "OK" : "NOK");
       return new JsonResponse(array( "status" => $status ));
     }

    /**
     * Pull data by key.
     *
     * @ApiDoc(
     *  resource=true,
     * )
     */
     public function pullAction($key)
     {
        return new JsonResponse($this->get('statts_data_service')->fetch($key));
     }

}
