<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="signatures", uniqueConstraints = {@ORM\UniqueConstraint(name="code_idx", columns={"code"})})
 */
class Signature {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $world;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $type;

    /**
     * @ORM\Column(type="string")
     */
    protected $code;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $player;

    /**
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $alliance;

    /**
     * @ORM\Column(type="string")
     */
    protected $params;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_used;


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
     * Set type
     *
     * @param integer $type
     * @return Signature
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
     * Set code
     *
     * @param string $code
     * @return Signature
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return Signature
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Signature
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
     * Set last_used
     *
     * @param \DateTime $lastUsed
     * @return Signature
     */
    public function setLastUsed($lastUsed)
    {
        $this->last_used = $lastUsed;

        return $this;
    }

    /**
     * Get last_used
     *
     * @return \DateTime
     */
    public function getLastUsed()
    {
        return $this->last_used;
    }

    /**
     * Set world
     *
     * @param \Hws\CncstatsBundle\Entity\World $world
     * @return Signature
     */
    public function setWorld(\Hws\CncstatsBundle\Entity\World $world = null)
    {
        $this->world = $world;

        return $this;
    }

    /**
     * Get world
     *
     * @return \Hws\CncstatsBundle\Entity\World
     */
    public function getWorld()
    {
        return $this->world;
    }

    /**
     * Set player
     *
     * @param \Hws\CncstatsBundle\Entity\Player $player
     * @return Signature
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
     * Set alliance
     *
     * @param \Hws\CncstatsBundle\Entity\Alliance $alliance
     * @return Signature
     */
    public function setAlliance(\Hws\CncstatsBundle\Entity\Alliance $alliance = null)
    {
        $this->alliance = $alliance;

        return $this;
    }

    /**
     * Get alliance
     *
     * @return \Hws\CncstatsBundle\Entity\Alliance
     */
    public function getAlliance()
    {
        return $this->alliance;
    }
}