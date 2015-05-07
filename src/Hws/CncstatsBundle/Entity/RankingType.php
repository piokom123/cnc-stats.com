<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="rankings_types")
 */
class RankingType {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options = {"unsigned" = true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * @ORM\Column(type="string")
     */
    protected $table;

    /**
     * @ORM\Column(type="string")
     */
    protected $column;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $active;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $required_account;

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
     * Set name
     *
     * @param string $name
     * @return RankingType
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
     * Set type
     *
     * @param string $type
     * @return RankingType
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set table
     *
     * @param string $table
     * @return RankingType
     */
    public function setTable($table)
    {
        $this->table = $table;
    
        return $this;
    }

    /**
     * Get table
     *
     * @return string 
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set column
     *
     * @param string $column
     * @return RankingType
     */
    public function setColumn($column)
    {
        $this->column = $column;
    
        return $this;
    }

    /**
     * Get column
     *
     * @return string 
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return RankingType
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }


    /**
     * Set required_account
     *
     * @param integer $requiredAccount
     * @return RankingType
     */
    public function setRequiredAccount($requiredAccount)
    {
        $this->required_account = $requiredAccount;
    
        return $this;
    }

    /**
     * Get required_account
     *
     * @return integer 
     */
    public function getRequiredAccount()
    {
        return $this->required_account;
    }
}