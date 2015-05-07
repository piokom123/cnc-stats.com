<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="rankings_rows")
 */
class RankingRow {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ranking")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $ranking_id;

    /**
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $world_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * @ORM\Column(type="integer")
     */
    protected $ranking;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $base_id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $base_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $player_id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $player_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $alliance_id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $alliance_name;


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
     * Set ranking_id
     *
     * @param integer $rankingId
     * @return RankingRow
     */
    public function setRankingId($rankingId)
    {
        $this->ranking_id = $rankingId;
    
        return $this;
    }

    /**
     * Get ranking_id
     *
     * @return integer 
     */
    public function getRankingId()
    {
        return $this->ranking_id;
    }

    /**
     * Set world_id
     *
     * @param integer $worldId
     * @return RankingRow
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
     * Set value
     *
     * @param integer $value
     * @return RankingRow
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set ranking
     *
     * @param integer $ranking
     * @return RankingRow
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;
    
        return $this;
    }

    /**
     * Get ranking
     *
     * @return integer 
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Set base_id
     *
     * @param integer $baseId
     * @return RankingRow
     */
    public function setBaseId($baseId)
    {
        $this->base_id = $baseId;
    
        return $this;
    }

    /**
     * Get base_id
     *
     * @return integer 
     */
    public function getBaseId()
    {
        return $this->base_id;
    }

    /**
     * Set base_name
     *
     * @param string $baseName
     * @return RankingRow
     */
    public function setBaseName($baseName)
    {
        $this->base_name = $baseName;
    
        return $this;
    }

    /**
     * Get base_name
     *
     * @return string 
     */
    public function getBaseName()
    {
        return $this->base_name;
    }

    /**
     * Set player_id
     *
     * @param integer $playerId
     * @return RankingRow
     */
    public function setPlayerId($playerId)
    {
        $this->player_id = $playerId;
    
        return $this;
    }

    /**
     * Get player_id
     *
     * @return integer 
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Set player_name
     *
     * @param string $playerName
     * @return RankingRow
     */
    public function setPlayerName($playerName)
    {
        $this->player_name = $playerName;
    
        return $this;
    }

    /**
     * Get player_name
     *
     * @return string 
     */
    public function getPlayerName()
    {
        return $this->player_name;
    }

    /**
     * Set alliance_id
     *
     * @param integer $allianceId
     * @return RankingRow
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
     * Set alliance_name
     *
     * @param string $allianceName
     * @return RankingRow
     */
    public function setAllianceName($allianceName)
    {
        $this->alliance_name = $allianceName;
    
        return $this;
    }

    /**
     * Get alliance_name
     *
     * @return string 
     */
    public function getAllianceName()
    {
        return $this->alliance_name;
    }
}