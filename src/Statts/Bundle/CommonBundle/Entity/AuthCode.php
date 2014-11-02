<?php 

namespace Statts\Bundle\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;

class AuthCode extends BaseAuthCode
{
  protected $id;
  protected $client;

}

