<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="alliances", uniqueConstraints = {@ORM\UniqueConstraint(name="external_idx", columns={"external_id"})})
 */
class Alliance {

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
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name_short;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $members_count;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
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
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $score_overall;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $score_top;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $score_average;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois2;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois3;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois4;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois5;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois6;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois7;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $pois8;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois_points;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois2_points;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois3_points;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois4_points;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois5_points;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois6_points;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois7_points;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $pois8_points;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned", nullable=true)
     */
    protected $members_bases;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $bases_destroyed_overall;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $bases_destroyed_pvp;

    /**
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $bases_destroyed_pve;

    /**
     * @ORM\Column(columnDefinition="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $removed;

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
     * @ORM\Column(columnDefinition="integer unsigned", nullable=true)
     */
    protected $distance_average_ranking;



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
     * @return Alliance
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
     * @return Alliance
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
     * Set name_short
     *
     * @param string $nameShort
     * @return Alliance
     */
    public function setNameShort($nameShort)
    {
        $this->name_short = $nameShort;

        return $this;
    }

    /**
     * Get name_short
     *
     * @return string
     */
    public function getNameShort()
    {
        return $this->name_short;
    }

    /**
     * Set members_count
     *
     * @param string $membersCount
     * @return Alliance
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
     * Set _score_ranking
     *
     * @param string $scoreRanking
     * @return Alliance
     */
    public function setScoreRanking($scoreRanking)
    {
        $this->score_ranking = $scoreRanking;

        return $this;
    }

    /**
     * Get _score_ranking
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
     * @return Alliance
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
     * @return Alliance
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
     * @return Alliance
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
     * Set score_overall
     *
     * @param string $scoreOverall
     * @return Alliance
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
     * @return Alliance
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
     * @return Alliance
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
     * Set pois
     *
     * @param string $pois
     * @return Alliance
     */
    public function setPois($pois)
    {
        $this->pois = $pois;

        return $this;
    }

    /**
     * Get pois
     *
     * @return string
     */
    public function getPois()
    {
        return $this->pois;
    }

    /**
     * Set pois2
     *
     * @param string $pois2
     * @return Alliance
     */
    public function setPois2($pois2)
    {
        $this->pois2 = $pois2;

        return $this;
    }

    /**
     * Get pois2
     *
     * @return string
     */
    public function getPois2()
    {
        return $this->pois2;
    }

    /**
     * Set pois3
     *
     * @param string $pois3
     * @return Alliance
     */
    public function setPois3($pois3)
    {
        $this->pois3 = $pois3;

        return $this;
    }

    /**
     * Get pois3
     *
     * @return string
     */
    public function getPois3()
    {
        return $this->pois3;
    }

    /**
     * Set pois4
     *
     * @param string $pois4
     * @return Alliance
     */
    public function setPois4($pois4)
    {
        $this->pois4 = $pois4;

        return $this;
    }

    /**
     * Get pois4
     *
     * @return string
     */
    public function getPois4()
    {
        return $this->pois4;
    }

    /**
     * Set pois5
     *
     * @param string $pois5
     * @return Alliance
     */
    public function setPois5($pois5)
    {
        $this->pois5 = $pois5;

        return $this;
    }

    /**
     * Get pois5
     *
     * @return string
     */
    public function getPois5()
    {
        return $this->pois5;
    }

    /**
     * Set pois6
     *
     * @param string $pois6
     * @return Alliance
     */
    public function setPois6($pois6)
    {
        $this->pois6 = $pois6;

        return $this;
    }

    /**
     * Get pois6
     *
     * @return string
     */
    public function getPois6()
    {
        return $this->pois6;
    }

    /**
     * Set pois7
     *
     * @param string $pois7
     * @return Alliance
     */
    public function setPois7($pois7)
    {
        $this->pois7 = $pois7;

        return $this;
    }

    /**
     * Get pois7
     *
     * @return string
     */
    public function getPois7()
    {
        return $this->pois7;
    }

    /**
     * Set pois8
     *
     * @param string $pois8
     * @return Alliance
     */
    public function setPois8($pois8)
    {
        $this->pois8 = $pois8;

        return $this;
    }

    /**
     * Get pois8
     *
     * @return string
     */
    public function getPois8()
    {
        return $this->pois8;
    }

    /**
     * Set pois_points
     *
     * @param string $poisPoints
     * @return Alliance
     */
    public function setPoisPoints($poisPoints)
    {
        $this->pois_points = $poisPoints;

        return $this;
    }

    /**
     * Get pois_points
     *
     * @return string
     */
    public function getPoisPoints()
    {
        return $this->pois_points;
    }

    /**
     * Set pois2_points
     *
     * @param string $pois2Points
     * @return Alliance
     */
    public function setPois2Points($pois2Points)
    {
        $this->pois2_points = $pois2Points;

        return $this;
    }

    /**
     * Get pois2_points
     *
     * @return string
     */
    public function getPois2Points()
    {
        return $this->pois2_points;
    }

    /**
     * Set pois3_points
     *
     * @param string $pois3Points
     * @return Alliance
     */
    public function setPois3Points($pois3Points)
    {
        $this->pois3_points = $pois3Points;

        return $this;
    }

    /**
     * Get pois3_points
     *
     * @return string
     */
    public function getPois3Points()
    {
        return $this->pois3_points;
    }

    /**
     * Set pois4_points
     *
     * @param string $pois4Points
     * @return Alliance
     */
    public function setPois4Points($pois4Points)
    {
        $this->pois4_points = $pois4Points;

        return $this;
    }

    /**
     * Get pois4_points
     *
     * @return string
     */
    public function getPois4Points()
    {
        return $this->pois4_points;
    }

    /**
     * Set pois5_points
     *
     * @param string $pois5Points
     * @return Alliance
     */
    public function setPois5Points($pois5Points)
    {
        $this->pois5_points = $pois5Points;

        return $this;
    }

    /**
     * Get pois5_points
     *
     * @return string
     */
    public function getPois5Points()
    {
        return $this->pois5_points;
    }

    /**
     * Set pois6_points
     *
     * @param string $pois6Points
     * @return Alliance
     */
    public function setPois6Points($pois6Points)
    {
        $this->pois6_points = $pois6Points;

        return $this;
    }

    /**
     * Get pois6_points
     *
     * @return string
     */
    public function getPois6Points()
    {
        return $this->pois6_points;
    }

    /**
     * Set pois7_points
     *
     * @param string $pois7Points
     * @return Alliance
     */
    public function setPois7Points($pois7Points)
    {
        $this->pois7_points = $pois7Points;

        return $this;
    }

    /**
     * Get pois7_points
     *
     * @return string
     */
    public function getPois7Points()
    {
        return $this->pois7_points;
    }

    /**
     * Set pois8_points
     *
     * @param string $pois8Points
     * @return Alliance
     */
    public function setPois8Points($pois8Points)
    {
        $this->pois8_points = $pois8Points;

        return $this;
    }

    /**
     * Get pois8_points
     *
     * @return string
     */
    public function getPois8Points()
    {
        return $this->pois8_points;
    }

    /**
     * Set members_bases
     *
     * @param string $membersBases
     * @return Alliance
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
     * @return Alliance
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
     * @return Alliance
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
     * @return Alliance
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
     * Set description
     *
     * @param string $description
     * @return Alliance
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Alliance
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
     * Set last_update
     *
     * @param \DateTime $lastUpdate
     * @return Alliance
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
     * Set removed
     *
     * @param string $removed
     * @return Alliance
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
     * Set distance_average
     *
     * @param string $distanceAverage
     * @return Alliance
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
     * @return Alliance
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
     * @return Alliance
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
     * Set distance_average_ranking
     *
     * @param string $distanceAverageRanking
     * @return Alliance
     */
    public function setDistanceAverageRanking($distanceAverageRanking)
    {
        $this->distance_average_ranking = $distanceAverageRanking;

        return $this;
    }

    /**
     * Get distance_average_ranking
     *
     * @return string
     */
    public function getDistanceAverageRanking()
    {
        return $this->distance_average_ranking;
    }
}