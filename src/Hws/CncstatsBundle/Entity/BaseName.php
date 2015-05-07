<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="bases_names")
 */
class BaseName {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Base")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $base;

    /**
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $world_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $old_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $new_name;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;


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
     * Set old_name
     *
     * @param string $oldName
     * @return BaseName
     */
    public function setOldName($oldName)
    {
        $this->old_name = $oldName;

        return $this;
    }

    /**
     * Get old_name
     *
     * @return string
     */
    public function getOldName()
    {
        return $this->old_name;
    }

    /**
     * Set new_name
     *
     * @param string $newName
     * @return BaseName
     */
    public function setNewName($newName)
    {
        $this->new_name = $newName;

        return $this;
    }

    /**
     * Get new_name
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->new_name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return BaseName
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set base_id
     *
     * @param \Hws\CncstatsBundle\Entity\Base $baseId
     * @return BaseName
     */
    public function setBaseId(\Hws\CncstatsBundle\Entity\Base $baseId = null)
    {
        $this->base_id = $baseId;

        return $this;
    }

    /**
     * Get base_id
     *
     * @return \Hws\CncstatsBundle\Entity\Base
     */
    public function getBaseId()
    {
        return $this->base_id;
    }

    /**
     * Set world_id
     *
     * @param integer $worldId
     * @return BaseName
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
     * Set base
     *
     * @param \Hws\CncstatsBundle\Entity\Base $base
     * @return BaseName
     */
    public function setBase(\Hws\CncstatsBundle\Entity\Base $base = null)
    {
        $this->base = $base;
    
        return $this;
    }

    /**
     * Get base
     *
     * @return \Hws\CncstatsBundle\Entity\Base 
     */
    public function getBase()
    {
        return $this->base;
    }
}