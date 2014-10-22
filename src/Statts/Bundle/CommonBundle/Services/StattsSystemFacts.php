<?php
namespace Statts\Bundle\CommonBundle\Services;

class StattsSystemFacts
{
  protected $facts;

  public function __construct()
  {
    $this->facts = array();

    /* Not putting facts in cache yet */
    $this->collectFacts();
  }

  public function getFacts($hostname='localhost')
  {
    return $this->facts;
  }

  protected function collectFacts()
  {
    $temp = array();
    $temp['hostname'] = gethostname();
    $temp['os'] = PHP_OS;
    $temp['zend_version'] = zend_version();
    $temp['php_version'] = phpversion();

    $this->facts = $temp;
  }

}
