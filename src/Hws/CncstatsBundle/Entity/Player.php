<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="players", uniqueConstraints = {@ORM\UniqueConstraint(name="external_idx", columns={"external_id"})})
 */
class Player {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $external_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_overall;

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
    protected $score_ranking;

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
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(name="alliance_id", referencedColumnName="id")
     */
    protected $alliance_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $removed;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $fraction;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance_current;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance_best;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $distance_worst;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $distance_ranking;

    /**
     * @ORM\Column(columnDefinition="decimal(10,2) unsigned")
     */
    protected $inactive_days;

    /**
     * @ORM\Column(columnDefinition="decimal(10,2) unsigned")
     */
    protected $inactive_max;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $active;


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
     * Set external_id
     *
     * @param string $externalId
     * @return Player
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
     * Set name
     *
     * @param string $name
     * @return Player
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
     * Set score_overall
     *
     * @param string $scoreOverall
     * @return Player
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
     * Set bases_count
     *
     * @param string $basesCount
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * Set score_ranking
     *
     * @param string $scoreRanking
     * @return Player
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
     * Set bases_destroyed_ranking_overall
     *
     * @param string $basesDestroyedRankingOverall
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * @return Player
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
     * Set removed
     *
     * @param string $removed
     * @return Player
     */
    public function setRemoved($removed)
    {
        $this->removed = $removed;

        return $this;
    }

    /**
     * Get removed
     *
     * @return string
     */
    public function getRemoved()
    {
        return $this->removed;
    }

    /**
     * Set last_update
     *
     * @param \DateTime $lastUpdate
     * @return Player
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
     * Set fraction
     *
     * @param integer $fraction
     * @return Player
     */
    public function setFraction($fraction)
    {
        $this->fraction = $fraction;

        return $this;
    }

    /**
     * Get fraction
     *
     * @return integer
     */
    public function getFraction()
    {
        return $this->fraction;
    }

    /**
     * Set distance_current
     *
     * @param string $distanceCurrent
     * @return Player
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
     * Set distance_best
     *
     * @param string $distanceBest
     * @return Player
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
     * @return Player
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
     * Set distance_ranking
     *
     * @param string $distanceRanking
     * @return Player
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
     * Set inactive_days
     *
     * @param string $inactiveDays
     * @return Player
     */
    public function setInactiveDays($inactiveDays)
    {
        $this->inactive_days = $inactiveDays;

        return $this;
    }

    /**
     * Get inactive_days
     *
     * @return string
     */
    public function getInactiveDays()
    {
        return $this->inactive_days;
    }

    /**
     * Set inactive_max
     *
     * @param string $inactiveMax
     * @return Player
     */
    public function setInactiveMax($inactiveMax)
    {
        $this->inactive_max = $inactiveMax;

        return $this;
    }

    /**
     * Get inactive_max
     *
     * @return string
     */
    public function getInactiveMax()
    {
        return $this->inactive_max;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Player
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set alliance_id
     *
     * @param \Hws\CncstatsBundle\Entity\Alliance $allianceId
     * @return Player
     */
    public function setAllianceId(\Hws\CncstatsBundle\Entity\Alliance $allianceId = null)
    {
        $this->alliance_id = $allianceId;

        return $this;
    }

    /**
     * Get alliance_id
     *
     * @return \Hws\CncstatsBundle\Entity\Alliance
     */
    public function getAllianceId()
    {
        return $this->alliance_id;
    }
}