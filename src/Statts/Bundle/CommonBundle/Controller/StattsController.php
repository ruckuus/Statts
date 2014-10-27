<?php

namespace Statts\Bundle\CommonBundle\Controller;

use Statts\Bundle\CommonBundle\Entity\Entries;
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
       $em = $this->getDoctrine()->getManager();
       $repository = $this->getDoctrine()->getRepository('StattsCommonBundle:Entries');
       $entry = new Entries();

       foreach($data as $key => $value) {
         $status = 200;
         $this->get('aequasi_cache.redis')->save($key, $value);
         /* Try to findByEntryName */
         $oldEntry = $repository->findOneByEntryName($key);

         if (is_array($value)) {
          $value = json_encode($value);
         }

         if (!$oldEntry) {
            /* Create a new record */
            $entry->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
            $entry->setEntryName($key);
            $entry->setEntryValue($value);
            $em->persist($entry);
          } else {
            $oldEntry->setEntryValue($value);
          }

          $em->flush();
       }

       return new JsonResponse(array( "data" => $data ), $status);
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

        $repository = $this->getDoctrine()->getRepository('StattsCommonBundle:Entries');

        $dataFromDb = $repository->findOneByEntryName($key);

        $key = $dataFromDb->getEntryName();
        $value = (null === ($tmp = json_decode($dataFromDb->getEntryValue()))) ? $dataFromDb->getEntryValue() : $tmp;

        $data = array(
          $key => $value
        );

        return new JsonResponse($data);
     }

}
