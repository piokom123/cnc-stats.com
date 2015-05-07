<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="rankings")
 */
class Ranking {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="RankingType")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $type_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $period_type;

    /**
     * @ORM\Column(type="date")
     */
    protected $period_start;

    /**
     * @ORM\Column(type="date")
     */
    protected $period_end;

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
     * Set type_id
     *
     * @param integer $typeId
     * @return Ranking
     */
    public function setTypeId($typeId)
    {
        $this->type_id = $typeId;
    
        return $this;
    }

    /**
     * Get type_id
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set period_type
     *
     * @param integer $periodType
     * @return Ranking
     */
    public function setPeriodType($periodType)
    {
        $this->period_type = $periodType;
    
        return $this;
    }

    /**
     * Get period_type
     *
     * @return integer 
     */
    public function getPeriodType()
    {
        return $this->period_type;
    }

    /**
     * Set period_start
     *
     * @param \DateTime $periodStart
     * @return Ranking
     */
    public function setPeriodStart($periodStart)
    {
        $this->period_start = $periodStart;
    
        return $this;
    }

    /**
     * Get period_start
     *
     * @return \DateTime 
     */
    public function getPeriodStart()
    {
        return $this->period_start;
    }

    /**
     * Set period_end
     *
     * @param \DateTime $periodEnd
     * @return Ranking
     */
    public function setPeriodEnd($periodEnd)
    {
        $this->period_end = $periodEnd;
    
        return $this;
    }

    /**
     * Get period_end
     *
     * @return \DateTime 
     */
    public function getPeriodEnd()
    {
        return $this->period_end;
    }
}