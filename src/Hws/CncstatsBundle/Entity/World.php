<?php

namespace Hws\CncstatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="worlds")
 */
class World {

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
     * @ORM\Column(type="integer")
     */
    protected $external_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $login;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $do_show;

    /**
     * @ORM\Column(columnDefinition="smallint unsigned")
     */
    protected $do_update;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $alliances;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $players;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $bases_destroyed;

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
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $players_inactive3;

    /**
     * @ORM\Column(columnDefinition="integer unsigned")
     */
    protected $players_inactive7;

    /**
     * @ORM\Column(columnDefinition="smallint", nullable=true)
     */
    protected $service_id;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $updateAlliancesList;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $updateAlliancesDetails;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $updatePlayersList;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $updatePlayersDetails;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $updateDaily;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $language;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $languageCode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $tries;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $last_update_alliances;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $last_update_players;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $last_update_daily;

    /**
     * @ORM\Column(columnDefinition="date", nullable=true)
     */
    protected $last_update_backups;


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return World
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
     * Set login
     *
     * @param string $login
     * @return World
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return World
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set show
     *
     * @param string $show
     * @return World
     */
    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }

    /**
     * Get show
     *
     * @return string
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set update
     *
     * @param string $update
     * @return World
     */
    public function setUpdate($update)
    {
        $this->update = $update;

        return $this;
    }

    /**
     * Get update
     *
     * @return string
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * Set external_id
     *
     * @param integer $externalId
     * @return World
     */
    public function setExternalId($externalId)
    {
        $this->external_id = $externalId;

        return $this;
    }

    /**
     * Get external_id
     *
     * @return integer
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Set do_show
     *
     * @param string $doShow
     * @return World
     */
    public function setDoShow($doShow)
    {
        $this->do_show = $doShow;

        return $this;
    }

    /**
     * Get do_show
     *
     * @return string
     */
    public function getDoShow()
    {
        return $this->do_show;
    }

    /**
     * Set do_update
     *
     * @param string $doUpdate
     * @return World
     */
    public function setDoUpdate($doUpdate)
    {
        $this->do_update = $doUpdate;

        return $this;
    }

    /**
     * Get do_update
     *
     * @return string
     */
    public function getDoUpdate()
    {
        return $this->do_update;
    }

    /**
     * Set alliances
     *
     * @param string $alliances
     * @return World
     */
    public function setAlliances($alliances)
    {
        $this->alliances = $alliances;

        return $this;
    }

    /**
     * Get alliances
     *
     * @return string
     */
    public function getAlliances()
    {
        return $this->alliances;
    }

    /**
     * Set players
     *
     * @param string $players
     * @return World
     */
    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }

    /**
     * Get players
     *
     * @return string
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Set bases
     *
     * @param string $bases
     * @return World
     */
    public function setBases($bases)
    {
        $this->bases = $bases;

        return $this;
    }

    /**
     * Get bases
     *
     * @return string
     */
    public function getBases()
    {
        return $this->bases;
    }

    /**
     * Set bases_destroyed
     *
     * @param string $basesDestroyed
     * @return World
     */
    public function setBasesDestroyed($basesDestroyed)
    {
        $this->bases_destroyed = $basesDestroyed;

        return $this;
    }

    /**
     * Get bases_destroyed
     *
     * @return string
     */
    public function getBasesDestroyed()
    {
        return $this->bases_destroyed;
    }

    /**
     * Set pois
     *
     * @param string $pois
     * @return World
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
	if($this->pois == 0)
	    return 1;
        return $this->pois;
    }

    /**
     * Set pois2
     *
     * @param string $pois2
     * @return World
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
	if($this->pois2 == 0)
	    return 1;
        return $this->pois2;
    }

    /**
     * Set pois3
     *
     * @param string $pois3
     * @return World
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
	if($this->pois3 == 0)
	    return 1;
        return $this->pois3;
    }

    /**
     * Set pois4
     *
     * @param string $pois4
     * @return World
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
	if($this->pois4 == 0)
	    return 1;
        return $this->pois4;
    }

    /**
     * Set pois5
     *
     * @param string $pois5
     * @return World
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
	if($this->pois5 == 0)
	    return 1;
        return $this->pois5;
    }

    /**
     * Set pois6
     *
     * @param string $pois6
     * @return World
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
	if($this->pois6 == 0)
	    return 1;
        return $this->pois6;
    }

    /**
     * Set pois7
     *
     * @param string $pois7
     * @return World
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
	if($this->pois7 == 0)
	    return 1;
        return $this->pois7;
    }

    /**
     * Set pois8
     *
     * @param string $pois8
     * @return World
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
    public function getPois8() {
	if($this->pois8 == 0)
	    return 1;
        return $this->pois8;
    }

    /**
     * Set players_inactive3
     *
     * @param string $playersInactive3
     * @return World
     */
    public function setPlayersInactive3($playersInactive3)
    {
        $this->players_inactive3 = $playersInactive3;

        return $this;
    }

    /**
     * Get players_inactive3
     *
     * @return string
     */
    public function getPlayersInactive3()
    {
        return $this->players_inactive3;
    }

    /**
     * Set players_inactive7
     *
     * @param string $playersInactive7
     * @return World
     */
    public function setPlayersInactive7($playersInactive7)
    {
        $this->players_inactive7 = $playersInactive7;

        return $this;
    }

    /**
     * Get players_inactive7
     *
     * @return string
     */
    public function getPlayersInactive7()
    {
        return $this->players_inactive7;
    }

    /**
     * Set service_id
     *
     * @param string $serviceId
     * @return World
     */
    public function setServiceId($serviceId)
    {
        $this->service_id = $serviceId;

        return $this;
    }

    /**
     * Get service_id
     *
     * @return string
     */
    public function getServiceId()
    {
        return $this->service_id;
    }

    /**
     * Set updateAlliancesList
     *
     * @param string $updateAlliancesList
     * @return World
     */
    public function setUpdateAlliancesList($updateAlliancesList)
    {
        $this->updateAlliancesList = $updateAlliancesList;

        return $this;
    }

    /**
     * Get updateAlliancesList
     *
     * @return string
     */
    public function getUpdateAlliancesList()
    {
        return $this->updateAlliancesList;
    }

    /**
     * Set updateAlliancesDetails
     *
     * @param string $updateAlliancesDetails
     * @return World
     */
    public function setUpdateAlliancesDetails($updateAlliancesDetails)
    {
        $this->updateAlliancesDetails = $updateAlliancesDetails;

        return $this;
    }

    /**
     * Get updateAlliancesDetails
     *
     * @return string
     */
    public function getUpdateAlliancesDetails()
    {
        return $this->updateAlliancesDetails;
    }

    /**
     * Set updatePlayersList
     *
     * @param string $updatePlayersList
     * @return World
     */
    public function setUpdatePlayersList($updatePlayersList)
    {
        $this->updatePlayersList = $updatePlayersList;

        return $this;
    }

    /**
     * Get updatePlayersList
     *
     * @return string
     */
    public function getUpdatePlayersList()
    {
        return $this->updatePlayersList;
    }

    /**
     * Set updatePlayersDetails
     *
     * @param string $updatePlayersDetails
     * @return World
     */
    public function setUpdatePlayersDetails($updatePlayersDetails)
    {
        $this->updatePlayersDetails = $updatePlayersDetails;

        return $this;
    }

    /**
     * Get updatePlayersDetails
     *
     * @return string
     */
    public function getUpdatePlayersDetails()
    {
        return $this->updatePlayersDetails;
    }

    /**
     * Set updateDaily
     *
     * @param string $updateDaily
     * @return World
     */
    public function setUpdateDaily($updateDaily)
    {
        $this->updateDaily = $updateDaily;

        return $this;
    }

    /**
     * Get updateDaily
     *
     * @return string
     */
    public function getUpdateDaily()
    {
        return $this->updateDaily;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return World
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set languageCode
     *
     * @param string $languageCode
     * @return World
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * Get languageCode
     *
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * Set tries
     *
     * @param integer $tries
     * @return World
     */
    public function setTries($tries)
    {
        $this->tries = $tries;
    
        return $this;
    }

    /**
     * Get tries
     *
     * @return integer 
     */
    public function getTries()
    {
        return $this->tries;
    }


    /**
     * Set last_update_alliances
     *
     * @param string $lastUpdateAlliances
     * @return World
     */
    public function setLastUpdateAlliances($lastUpdateAlliances)
    {
        $this->last_update_alliances = $lastUpdateAlliances;
    
        return $this;
    }

    /**
     * Get last_update_alliances
     *
     * @return string 
     */
    public function getLastUpdateAlliances()
    {
        return $this->last_update_alliances;
    }

    /**
     * Set last_update_players
     *
     * @param string $lastUpdatePlayers
     * @return World
     */
    public function setLastUpdatePlayers($lastUpdatePlayers)
    {
        $this->last_update_players = $lastUpdatePlayers;
    
        return $this;
    }

    /**
     * Get last_update_players
     *
     * @return string 
     */
    public function getLastUpdatePlayers()
    {
        return $this->last_update_players;
    }

    /**
     * Set last_update_daily
     *
     * @param string $lastUpdateDaily
     * @return World
     */
    public function setLastUpdateDaily($lastUpdateDaily)
    {
        $this->last_update_daily = $lastUpdateDaily;
    
        return $this;
    }

    /**
     * Get last_update_daily
     *
     * @return string 
     */
    public function getLastUpdateDaily()
    {
        return $this->last_update_daily;
    }

    /**
     * Set last_update_backups
     *
     * @param string $lastUpdateBackups
     * @return World
     */
    public function setLastUpdateBackups($lastUpdateBackups)
    {
        $this->last_update_backups = $lastUpdateBackups;
    
        return $this;
    }

    /**
     * Get last_update_backups
     *
     * @return string 
     */
    public function getLastUpdateBackups()
    {
        return $this->last_update_backups;
    }
}