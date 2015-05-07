<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="blocks")
 */
class Block {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $world_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $external_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $type;


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
     * Set world_id
     *
     * @param integer $worldId
     * @return Block
     */
    public function setWorldId($worldId)
    {
        $this->world_id = $worldId;
    
        return $this;
    }

    /**
     * Get world_id
     *
     * @return integer 
     */
    public function getWorldId()
    {
        return $this->world_id;
    }

    /**
     * Set external_id
     *
     * @param integer $externalId
     * @return Block
     */
    public function setExternalId($externalId)
    {
        $this->external_id = $externalId;
    
        return $this;
    }

    /**
     * Get external_id
     *
     * @return integer 
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Block
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }
}