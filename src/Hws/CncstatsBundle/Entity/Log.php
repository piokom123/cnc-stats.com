<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="logs")
 */
class Log {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $type;

    /**
     * @ORM\Column(type="string")
     */
    protected $script;

    /**
     * @ORM\Column(type="string")
     */
    protected $content;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\ManyToOne(targetEntity="Log")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $parent;

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
     * @return Log
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
     * Set script
     *
     * @param string $script
     * @return Log
     */
    public function setScript($script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script
     *
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Log
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Log
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
     * Set parent
     *
     * @param \Hws\CncstatsBundle\Entity\Log $parent
     * @return Log
     */
    public function setParent(\Hws\CncstatsBundle\Entity\Log $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Hws\CncstatsBundle\Entity\Log 
     */
    public function getParent()
    {
        return $this->parent;
    }
}