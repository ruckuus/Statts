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
       foreach($data as $key => $value) {
        $this->get('aequasi_cache.redis')->save($key, $value);
       }

       return new JsonResponse(array( "data" => $data ));
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
        $data = $this->get('aequasi_cache.redis')->fetch($key);

        return new JsonResponse(array($key => $data));
     }

}
