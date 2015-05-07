<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="pois")
 */
class Poi {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(referencedColumnName="external_id")
     * @ORM\Column(type="integer")
     */
    protected $alliance_external_id;

    /**
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $world_id;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $external_id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $coords;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $level;

    /**
     * @ORM\Column(type="integer")
     */
    protected $points;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $type;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

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
     * Set alliance_id
     *
     * @param integer $allianceId
     * @return Poi
     */
    public function setAllianceId($allianceId)
    {
        $this->alliance_external_id = $allianceId;

        return $this;
    }

    /**
     * Get alliance_id
     *
     * @return integer
     */
    public function getAllianceId()
    {
        return $this->alliance_external_id;
    }

    /**
     * Set world_id
     *
     * @param integer $worldId
     * @return Poi
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
     * @param string $externalId
     * @return Poi
     */
    public function setExternalId($externalId)
    {
        $this->external_id = $externalId;

        return $this;
    }

    /**
     * Get external_id
     *
     * @return string
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Set coords
     *
     * @param string $coords
     * @return Poi
     */
    public function setCoords($coords)
    {
        $this->coords = $coords;

        return $this;
    }

    /**
     * Get coords
     *
     * @return string
     */
    public function getCoords()
    {
        return $this->coords;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Poi
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Poi
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

    /**
     * Set last_update
     *
     * @param \DateTime $lastUpdate
     * @return Poi
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->last_update = $lastUpdate;

        return $this;
    }

    /**
     * Get last_update
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return Poi
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }
}