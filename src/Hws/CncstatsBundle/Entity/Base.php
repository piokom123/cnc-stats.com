<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="bases")
 */
class Base {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $player;

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
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $coords;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $ranking;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $level;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

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
    protected $last_update;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $path;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $path_reset;

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
        $this->alliance_id = $allianceId;

        return $this;
    }

    /**
     * Get alliance_id
     *
     * @return integer
     */
    public function getAllianceId()
    {
        return $this->alliance_id;
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
     * Set score
     *
     * @param string $score
     * @return Base
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set ranking
     *
     * @param string $ranking
     * @return Base
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * Get ranking
     *
     * @return string
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Set player_id
     *
     * @param \Hws\CncstatsBundle\Entity\Player $playerId
     * @return Base
     */
    public function setPlayerId(\Hws\CncstatsBundle\Entity\Player $playerId = null)
    {
        $this->player_id = $playerId;

        return $this;
    }

    /**
     * Get player_id
     *
     * @return \Hws\CncstatsBundle\Entity\Player
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Base
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Base
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
     * Set player
     *
     * @param \Hws\CncstatsBundle\Entity\Player $player
     * @return Base
     */
    public function setPlayer(\Hws\CncstatsBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Hws\CncstatsBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set distance
     *
     * @param string $distance
     * @return Base
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return string
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set distance_ranking
     *
     * @param string $distanceRanking
     * @return Base
     */
    public function setDistanceRanking($distanceRanking)
    {
        $this->distance_ranking = $distanceRanking;

        return $this;
    }

    /**
     * Get distance_ranking
     *
     * @return string
     */
    public function getDistanceRanking()
    {
        return $this->distance_ranking;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Base
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set pathReset
     *
     * @param string $pathReset
     * @return Base
     */
    public function setPathReset($pathReset)
    {
        $this->path_reset = $pathReset;

        return $this;
    }

    /**
     * Get pathReset
     *
     * @return string
     */
    public function getPathReset()
    {
        return $this->path_reset;
    }
}