<?php

namespace Statts\Bundle\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entries
 */
class Entries
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $entryName;

    /**
     * @var string
     */
    private $entryValue;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Entries
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set entryName
     *
     * @param string $entryName
     * @return Entries
     */
    public function setEntryName($entryName)
    {
        $this->entryName = $entryName;

        return $this;
    }

    /**
     * Get entryName
     *
     * @return string 
     */
    public function getEntryName()
    {
        return $this->entryName;
    }

    /**
     * Set entryValue
     *
     * @param string $entryValue
     * @return Entries
     */
    public function setEntryValue($entryValue)
    {
        $this->entryValue = $entryValue;

        return $this;
    }

    /**
     * Get entryValue
     *
     * @return string 
     */
    public function getEntryValue()
    {
        return $this->entryValue;
    }
}
