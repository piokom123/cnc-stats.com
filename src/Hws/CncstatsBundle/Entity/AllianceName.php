<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="alliances_name")
 */
class AllianceName {

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
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    protected $world_id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $old_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $new_name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $old_name_short;

    /**
     * @ORM\Column(type="string")
     */
    protected $new_name_short;

    /**
     * @ORM\Column(type="datetime")
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
     * @return AllianceName
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
     * Set world_id
     *
     * @param integer $worldId
     * @return AllianceName
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
     * Set name
     *
     * @param string $name
     * @return AllianceName
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
     * @return AllianceName
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
     * Set date
     *
     * @param \DateTime $date
     * @return AllianceName
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
     * Set old_name
     *
     * @param string $oldName
     * @return AllianceName
     */
    public function setOldName($oldName)
    {
        $this->old_name = $oldName;

        return $this;
    }

    /**
     * Get old_name
     *
     * @return string
     */
    public function getOldName()
    {
        return $this->old_name;
    }

    /**
     * Set new_name
     *
     * @param string $newName
     * @return AllianceName
     */
    public function setNewName($newName)
    {
        $this->new_name = $newName;

        return $this;
    }

    /**
     * Get new_name
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->new_name;
    }

    /**
     * Set old_name_short
     *
     * @param string $oldNameShort
     * @return AllianceName
     */
    public function setOldNameShort($oldNameShort)
    {
        $this->old_name_short = $oldNameShort;

        return $this;
    }

    /**
     * Get old_name_short
     *
     * @return string
     */
    public function getOldNameShort()
    {
        return $this->old_name_short;
    }

    /**
     * Set new_name_short
     *
     * @param string $newNameShort
     * @return AllianceName
     */
    public function setNewNameShort($newNameShort)
    {
        $this->new_name_short = $newNameShort;

        return $this;
    }

    /**
     * Get new_name_short
     *
     * @return string
     */
    public function getNewNameShort()
    {
        return $this->new_name_short;
    }
}