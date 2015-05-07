<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="bases_coords")
 */
class BaseCoords {

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
    protected $old_coords;

    /**
     * @ORM\Column(type="string")
     */
    protected $new_coords;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $distance_ranking;

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
     * Set old_coords
     *
     * @param string $oldCoords
     * @return BaseCoords
     */
    public function setOldCoords($oldCoords)
    {
        $this->old_coords = $oldCoords;

        return $this;
    }

    /**
     * Get old_coords
     *
     * @return string
     */
    public function getOldCoords()
    {
        return $this->old_coords;
    }

    /**
     * Set new_coords
     *
     * @param string $newCoords
     * @return BaseCoords
     */
    public function setNewCoords($newCoords)
    {
        $this->new_coords = $newCoords;

        return $this;
    }

    /**
     * Get new_coords
     *
     * @return string
     */
    public function getNewCoords()
    {
        return $this->new_coords;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return BaseCoords
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
     * @return BaseCoords
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
     * @return BaseCoords
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
     * @return BaseCoords
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