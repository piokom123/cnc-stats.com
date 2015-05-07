<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="players_level_type")
 */
class PlayerLevelType {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $level;

    /**
     * @ORM\Column(type="string")
     */
    protected $gdi_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $gdi_image;

    /**
     * @ORM\Column(type="string")
     */
    protected $nod_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $nod_image;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_minimum;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $score_maximum;


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
     * Set level
     *
     * @param integer $level
     * @return PlayerLevelType
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set gdi_name
     *
     * @param string $gdiName
     * @return PlayerLevelType
     */
    public function setGdiName($gdiName)
    {
        $this->gdi_name = $gdiName;
    
        return $this;
    }

    /**
     * Get gdi_name
     *
     * @return string 
     */
    public function getGdiName()
    {
        return $this->gdi_name;
    }

    /**
     * Set gdi_image
     *
     * @param string $gdiImage
     * @return PlayerLevelType
     */
    public function setGdiImage($gdiImage)
    {
        $this->gdi_image = $gdiImage;
    
        return $this;
    }

    /**
     * Get gdi_image
     *
     * @return string 
     */
    public function getGdiImage()
    {
        return $this->gdi_image;
    }

    /**
     * Set nod_name
     *
     * @param string $nodName
     * @return PlayerLevelType
     */
    public function setNodName($nodName)
    {
        $this->nod_name = $nodName;
    
        return $this;
    }

    /**
     * Get nod_name
     *
     * @return string 
     */
    public function getNodName()
    {
        return $this->nod_name;
    }

    /**
     * Set nod_image
     *
     * @param string $nodImage
     * @return PlayerLevelType
     */
    public function setNodImage($nodImage)
    {
        $this->nod_image = $nodImage;
    
        return $this;
    }

    /**
     * Get nod_image
     *
     * @return string 
     */
    public function getNodImage()
    {
        return $this->nod_image;
    }

    /**
     * Set score_minimum
     *
     * @param string $scoreMinimum
     * @return PlayerLevelType
     */
    public function setScoreMinimum($scoreMinimum)
    {
        $this->score_minimum = $scoreMinimum;
    
        return $this;
    }

    /**
     * Get score_minimum
     *
     * @return string 
     */
    public function getScoreMinimum()
    {
        return $this->score_minimum;
    }

    /**
     * Set score_maximum
     *
     * @param string $scoreMaximum
     * @return PlayerLevelType
     */
    public function setScoreMaximum($scoreMaximum)
    {
        $this->score_maximum = $scoreMaximum;
    
        return $this;
    }

    /**
     * Get score_maximum
     *
     * @return string 
     */
    public function getScoreMaximum()
    {
        return $this->score_maximum;
    }
}