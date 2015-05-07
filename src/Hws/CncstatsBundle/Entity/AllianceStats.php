<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="alliances_stats", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="alliances_stats_date_idx", columns={"alliance_id", "date"})
 * })
 */
class AllianceStats {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $alliance_id;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_overall;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_top;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_average;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_ranking;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $members_count;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $members_bases;

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
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance_average;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance_best;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance_worst;

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
     * Set alliance_id
     *
     * @param integer $allianceId
     * @return AllianceStats
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
     * Set score_overall
     *
     * @param string $scoreOverall
     * @return AllianceStats
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
     * Set score_top
     *
     * @param string $scoreTop
     * @return AllianceStats
     */
    public function setScoreTop($scoreTop)
    {
        $this->score_top = $scoreTop;
    
        return $this;
    }

    /**
     * Get score_top
     *
     * @return string 
     */
    public function getScoreTop()
    {
        return $this->score_top;
    }

    /**
     * Set score_average
     *
     * @param string $scoreAverage
     * @return AllianceStats
     */
    public function setScoreAverage($scoreAverage)
    {
        $this->score_average = $scoreAverage;
    
        return $this;
    }

    /**
     * Get score_average
     *
     * @return string 
     */
    public function getScoreAverage()
    {
        return $this->score_average;
    }

    /**
     * Set score_ranking
     *
     * @param string $scoreRanking
     * @return AllianceStats
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
     * Set members_count
     *
     * @param string $membersCount
     * @return AllianceStats
     */
    public function setMembersCount($membersCount)
    {
        $this->members_count = $membersCount;
    
        return $this;
    }

    /**
     * Get members_count
     *
     * @return string 
     */
    public function getMembersCount()
    {
        return $this->members_count;
    }

    /**
     * Set members_bases
     *
     * @param string $membersBases
     * @return AllianceStats
     */
    public function setMembersBases($membersBases)
    {
        $this->members_bases = $membersBases;
    
        return $this;
    }

    /**
     * Get members_bases
     *
     * @return string 
     */
    public function getMembersBases()
    {
        return $this->members_bases;
    }

    /**
     * Set bases_destroyed_overall
     *
     * @param string $basesDestroyedOverall
     * @return AllianceStats
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
     * @return AllianceStats
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
     * @return AllianceStats
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
     * @return AllianceStats
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
     * @return AllianceStats
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
     * @return AllianceStats
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
     * Set distance_average
     *
     * @param string $distanceAverage
     * @return AllianceStats
     */
    public function setDistanceAverage($distanceAverage)
    {
        $this->distance_average = $distanceAverage;
    
        return $this;
    }

    /**
     * Get distance_average
     *
     * @return string 
     */
    public function getDistanceAverage()
    {
        return $this->distance_average;
    }

    /**
     * Set distance_best
     *
     * @param string $distanceBest
     * @return AllianceStats
     */
    public function setDistanceBest($distanceBest)
    {
        $this->distance_best = $distanceBest;
    
        return $this;
    }

    /**
     * Get distance_best
     *
     * @return string 
     */
    public function getDistanceBest()
    {
        return $this->distance_best;
    }

    /**
     * Set distance_worst
     *
     * @param string $distanceWorst
     * @return AllianceStats
     */
    public function setDistanceWorst($distanceWorst)
    {
        $this->distance_worst = $distanceWorst;
    
        return $this;
    }

    /**
     * Get distance_worst
     *
     * @return string 
     */
    public function getDistanceWorst()
    {
        return $this->distance_worst;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return AllianceStats
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