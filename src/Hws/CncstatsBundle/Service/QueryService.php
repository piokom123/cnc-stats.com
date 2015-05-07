<?php

namespace Hws\CncstatsBundle\Service;

class QueryService {
    private $defaultEm;
    private $em;
    private $world;
    private $mongoCon;
    private $mongoPrefix;

    public function __construct($defaultEm, $em, $world) {
        $this->defaultEm = $defaultEm;
        $this->em = $em;
        $this->world = $world;
        
        $this->mongoCon = new \MongoClient('mongodb://');
        $this->mongoPrefix = 'cncstatscom_world';
    }

    public function createQuery($em, $queryString, $cacheKey = null, $cacheTime = 21600) {
        if ($em === 'world') {
            $world = $this->world->getWorld();
            if ($cacheKey !== null) {
                $cacheKey = $cacheKey.'_'.$world['id'];
            } else {
                $cacheKey = md5($queryString).'_'.$world['id'];
            }
            return $this->em->createQuery($queryString)
                ->useResultCache(true, $cacheTime, $cacheKey);
        } else {
            return $this->defaultEm->createQuery($queryString)
                ->useResultCache(true, $cacheTime, $cacheKey);
        }
    }

    public function getMongoCollection($collection) {
        $world = $this->world->getWorld();

        return $this->mongoCon->{$this->mongoPrefix.$world['id']}->$collection;
    }
    
    public function getPlayers($ids) {
        $results = array();
        
        if (!is_array($ids) || empty($ids)) {
            return $results;
        }

        $items = $this->getMongoCollection('players')->find(array('exid' => array('$in' => $ids)));

        foreach ($items as $item) {
            $results[$item['exid']] = array(
                'externalId'    => $item['exid'],
                'name'          => $item['n'],
                'distanceBest'  => @$item['db'],
                'distanceWorst' => @$item['dw']
            );
        }
        
        return $results;
    }
    
    public function getAlliances($ids) {
        $results = array();
        
        if (!is_array($ids) || empty($ids)) {
            return $results;
        }
        
        $items = $this->getMongoCollection('alliances')->find(array('exid' => array('$in' => $ids)));

        foreach ($items as $item) {
            $results[$item['exid']] = array(
                'externalId'    => $item['exid'],
                'name'  => $item['n'],
                'nameShort' => $item['ns']
            );
        }
        
        if (in_array('0', $ids)) {
            $results[0] = array(
                'externalId'    => 0,
                'name'  => 'no alliance',
                'nameShort' => '-'
            );
        }
        
        return $results;
    }
    
    public function getBases($ids) {
        $results = array();
        
        if (!is_array($ids) || empty($ids)) {
            return $results;
        }

        $items = $this->getMongoCollection('bases')->find(array('exid' => array('$in' => $ids)));

        foreach ($items as $item) {
            $results[$item['exid']] = array(
                'externalId'    => $item['exid'],
                'name'          => $item['n'],
                'playerId'      => $item['pid']
            );
        }
        
        return $results;
    }
}