<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="players_alliances")
 */
class PlayerAlliance {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $player_id;

    /**
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $world_id;

    /**
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $old_alliance;

    /**
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $new_alliance;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set player_id
     *
     * @param string $playerId
     * @return PlayerAlliance
     */
    public function setPlayerId($playerId)
    {
        $this->player_id = $playerId;

        return $this;
    }

    /**
     * Get player_id
     *
     * @return string
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Set world_id
     *
     * @param string $worldId
     * @return PlayerAlliance
     */
    public function setWorldId($worldId)
    {
        $this->world_id = $worldId;

        return $this;
    }

    /**
     * Get world_id
     *
     * @return string
     */
    public function getWorldId()
    {
        return $this->world_id;
    }

    /**
     * Set alliance_id
     *
     * @param string $allianceId
     * @return PlayerAlliance
     */
    public function setAllianceId($allianceId)
    {
        $this->alliance_id = $allianceId;

        return $this;
    }

    /**
     * Get alliance_id
     *
     * @return string
     */
    public function getAllianceId()
    {
        return $this->alliance_id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return PlayerAlliance
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
     * Set old_alliance_id
     *
     * @param integer $oldAllianceId
     * @return PlayerAlliance
     */
    public function setOldAllianceId($oldAllianceId)
    {
        $this->old_alliance_id = $oldAllianceId;

        return $this;
    }

    /**
     * Get old_alliance_id
     *
     * @return integer
     */
    public function getOldAllianceId()
    {
        return $this->old_alliance_id;
    }

    /**
     * Set new_alliance_id
     *
     * @param integer $newAllianceId
     * @return PlayerAlliance
     */
    public function setNewAllianceId($newAllianceId)
    {
        $this->new_alliance_id = $newAllianceId;

        return $this;
    }

    /**
     * Get new_alliance_id
     *
     * @return integer
     */
    public function getNewAllianceId()
    {
        return $this->new_alliance_id;
    }

    /**
     * Set old_alliance
     *
     * @param \Hws\CncstatsBundle\Entity\Alliance $oldAlliance
     * @return PlayerAlliance
     */
    public function setOldAlliance(\Hws\CncstatsBundle\Entity\Alliance $oldAlliance = null)
    {
        $this->old_alliance = $oldAlliance;
    
        return $this;
    }

    /**
     * Get old_alliance
     *
     * @return \Hws\CncstatsBundle\Entity\Alliance 
     */
    public function getOldAlliance()
    {
        return $this->old_alliance;
    }

    /**
     * Set new_alliance
     *
     * @param \Hws\CncstatsBundle\Entity\Alliance $newAlliance
     * @return PlayerAlliance
     */
    public function setNewAlliance(\Hws\CncstatsBundle\Entity\Alliance $newAlliance = null)
    {
        $this->new_alliance = $newAlliance;
    
        return $this;
    }

    /**
     * Get new_alliance
     *
     * @return \Hws\CncstatsBundle\Entity\Alliance 
     */
    public function getNewAlliance()
    {
        return $this->new_alliance;
    }
}