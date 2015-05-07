<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="bases_scores")
 */
class BaseScore {

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
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $ranking;

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
     * Set score
     *
     * @param string $score
     * @return BaseScore
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
     * @return BaseScore
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
     * Set date
     *
     * @param \DateTime $date
     * @return BaseScore
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
     * @return BaseScore
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
     * @return BaseScore
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
     * @return BaseScore
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