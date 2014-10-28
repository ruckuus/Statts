<?php
namespace Statts\Bundle\CommonBundle\Services\Base;
use Statts\Bundle\CommonBundle\Entity\Entries;

class DataServiceBase
{
  private $doctrine;
  private $cache;

  /**
   * @params doctrine instance
   * @params cache instance
   */
  public function __construct($doctrine, $cache) {
    $this->doctrine = $doctrine;
    $this->cache = $cache;
  }

  /**
   * @params $key
   * @return array()
   */
  public function fetch($key) {
    $fromCache = $this->cache->fetch($key);
    $data = array(
      $key => $fromCache
    );

    if (!$fromCache) {
      $repository = $this->doctrine->getRepository('StattsCommonBundle:Entries');
      $dataFromDb = $repository->findOneByEntryName($key);
      $key = $dataFromDb->getEntryName();
      $value = (null === ($tmp = json_decode($dataFromDb->getEntryValue()))) 
        ? $dataFromDb->getEntryValue() 
        : $tmp;

      $data = array(
        $key => $value
      );
    }

    return $data;
  }

  /**
   * @params array()
   * @return boolean
   */
  public function save($data = array()) {
    $em = $this->doctrine->getManager();
    $repository = $this->doctrine->getRepository('StattsCommonBundle:Entries');
    $entry = new Entries();
    foreach($data as $key => $value) {
      $this->cache->save($key, $value);
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
    return true;
  }
}

