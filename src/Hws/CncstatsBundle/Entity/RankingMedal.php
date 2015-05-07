<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="rankings_medals", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="rankings_medal_item", columns={"type_id", "world_id", "item_id", "ranking", "period_type", "is_global"})
 * }))
 */
class RankingMedal {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $world_id;

    /**
     * @ORM\ManyToOne(targetEntity="RankingType")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $type_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $item_type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $period_type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $item_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $ranking;

    /**
     * @ORM\Column(type="integer")
     */
    protected $count;

    /**
     * @ORM\Column(type="integer")
     */
    protected $is_global;


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
     * Set world_id
     *
     * @param integer $worldId
     * @return RankingMedal
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
     * Set type_id
     *
     * @param integer $typeId
     * @return RankingMedal
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
     * Set item_type
     *
     * @param integer $itemType
     * @return RankingMedal
     */
    public function setItemType($itemType)
    {
        $this->item_type = $itemType;
    
        return $this;
    }

    /**
     * Get item_type
     *
     * @return integer 
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * Set period_type
     *
     * @param integer $periodType
     * @return RankingMedal
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
     * Set item_id
     *
     * @param integer $itemId
     * @return RankingMedal
     */
    public function setItemId($itemId)
    {
        $this->item_id = $itemId;
    
        return $this;
    }

    /**
     * Get item_id
     *
     * @return integer 
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Set ranking
     *
     * @param integer $ranking
     * @return RankingMedal
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
     * Set count
     *
     * @param integer $count
     * @return RankingMedal
     */
    public function setCount($count)
    {
        $this->count = $count;
    
        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }


    /**
     * Set is_global
     *
     * @param integer $isGlobal
     * @return RankingMedal
     */
    public function setIsGlobal($isGlobal)
    {
        $this->is_global = $isGlobal;
    
        return $this;
    }

    /**
     * Get is_global
     *
     * @return integer 
     */
    public function getIsGlobal()
    {
        return $this->is_global;
    }
}