<?php 

namespace Statts\Bundle\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
{
  protected $id;

  protected $client;

}

