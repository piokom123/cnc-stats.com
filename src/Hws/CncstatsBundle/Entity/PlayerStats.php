<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="players_stats", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="players_stats_date_idx", columns={"player_id", "date"})
 * })
 */
class PlayerStats {

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
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_overall;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_ranking;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance_current;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $distance_ranking;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $bases_count;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases_destroyed_overall;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases_destroyed_pvp;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases_destroyed_pve;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases_destroyed_ranking_overall;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases_destroyed_ranking_pvp;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases_destroyed_ranking_pve;

    /**
     * @ORM\Column(type="date")
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
     * Set player_id
     *
     * @param integer $playerId
     * @return PlayerStats
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
     * Set score_overall
     *
     * @param string $scoreOverall
     * @return PlayerStats
     */
    public function setScoreOverall($scoreOverall)
    {
        $this->score_overall = $scoreOverall;
    
        return $this;
    }

    /**
     * Get score_overall
     *
     * @return string 
     */
    public function getScoreOverall()
    {
        return $this->score_overall;
    }

    /**
     * Set score_ranking
     *
     * @param string $scoreRanking
     * @return PlayerStats
     */
    public function setScoreRanking($scoreRanking)
    {
        $this->score_ranking = $scoreRanking;
    
        return $this;
    }

    /**
     * Get score_ranking
     *
     * @return string 
     */
    public function getScoreRanking()
    {
        return $this->score_ranking;
    }

    /**
     * Set distance_current
     *
     * @param string $distanceCurrent
     * @return PlayerStats
     */
    public function setDistanceCurrent($distanceCurrent)
    {
        $this->distance_current = $distanceCurrent;
    
        return $this;
    }

    /**
     * Get distance_current
     *
     * @return string 
     */
    public function getDistanceCurrent()
    {
        return $this->distance_current;
    }

    /**
     * Set distance_ranking
     *
     * @param string $distanceRanking
     * @return PlayerStats
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
     * Set bases_count
     *
     * @param string $basesCount
     * @return PlayerStats
     */
    public function setBasesCount($basesCount)
    {
        $this->bases_count = $basesCount;
    
        return $this;
    }

    /**
     * Get bases_count
     *
     * @return string 
     */
    public function getBasesCount()
    {
        return $this->bases_count;
    }

    /**
     * Set bases_destroyed_overall
     *
     * @param string $basesDestroyedOverall
     * @return PlayerStats
     */
    public function setBasesDestroyedOverall($basesDestroyedOverall)
    {
        $this->bases_destroyed_overall = $basesDestroyedOverall;
    
        return $this;
    }

    /**
     * Get bases_destroyed_overall
     *
     * @return string 
     */
    public function getBasesDestroyedOverall()
    {
        return $this->bases_destroyed_overall;
    }

    /**
     * Set bases_destroyed_pvp
     *
     * @param string $basesDestroyedPvp
     * @return PlayerStats
     */
    public function setBasesDestroyedPvp($basesDestroyedPvp)
    {
        $this->bases_destroyed_pvp = $basesDestroyedPvp;
    
        return $this;
    }

    /**
     * Get bases_destroyed_pvp
     *
     * @return string 
     */
    public function getBasesDestroyedPvp()
    {
        return $this->bases_destroyed_pvp;
    }

    /**
     * Set bases_destroyed_pve
     *
     * @param string $basesDestroyedPve
     * @return PlayerStats
     */
    public function setBasesDestroyedPve($basesDestroyedPve)
    {
        $this->bases_destroyed_pve = $basesDestroyedPve;
    
        return $this;
    }

    /**
     * Get bases_destroyed_pve
     *
     * @return string 
     */
    public function getBasesDestroyedPve()
    {
        return $this->bases_destroyed_pve;
    }

    /**
     * Set bases_destroyed_ranking_overall
     *
     * @param string $basesDestroyedRankingOverall
     * @return PlayerStats
     */
    public function setBasesDestroyedRankingOverall($basesDestroyedRankingOverall)
    {
        $this->bases_destroyed_ranking_overall = $basesDestroyedRankingOverall;
    
        return $this;
    }

    /**
     * Get bases_destroyed_ranking_overall
     *
     * @return string 
     */
    public function getBasesDestroyedRankingOverall()
    {
        return $this->bases_destroyed_ranking_overall;
    }

    /**
     * Set bases_destroyed_ranking_pvp
     *
     * @param string $basesDestroyedRankingPvp
     * @return PlayerStats
     */
    public function setBasesDestroyedRankingPvp($basesDestroyedRankingPvp)
    {
        $this->bases_destroyed_ranking_pvp = $basesDestroyedRankingPvp;
    
        return $this;
    }

    /**
     * Get bases_destroyed_ranking_pvp
     *
     * @return string 
     */
    public function getBasesDestroyedRankingPvp()
    {
        return $this->bases_destroyed_ranking_pvp;
    }

    /**
     * Set bases_destroyed_ranking_pve
     *
     * @param string $basesDestroyedRankingPve
     * @return PlayerStats
     */
    public function setBasesDestroyedRankingPve($basesDestroyedRankingPve)
    {
        $this->bases_destroyed_ranking_pve = $basesDestroyedRankingPve;
    
        return $this;
    }

    /**
     * Get bases_destroyed_ranking_pve
     *
     * @return string 
     */
    public function getBasesDestroyedRankingPve()
    {
        return $this->bases_destroyed_ranking_pve;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return PlayerStats
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
}