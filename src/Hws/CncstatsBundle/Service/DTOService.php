<?php

namespace Hws\CncstatsBundle\Service;

class DTOService {
    public function playersHistoryToArray($cursor) {
        $items = array();
        
        foreach ($cursor as $item) {
            $items[] = $this->playerHistoryToArray($item);
        }
        
        return $items;
    }

    public function playerHistoryToArray($item) {
        return array(
            'externalId'                    => $item['exid'],
            'scoreOverall'                  => $item['so'],
            'scoreRanking'                  => $item['sor'],
            'distanceCurrent'               => @$item['dc'],
            'distanceRanking'               => @$item['dr'],
            'basesCount'                    => @$item['bc'],
            'rank'                          => @$item['r'],
            'allianceId'                    => $item['aid'],
            'basesDestroyedOverall'         => @$item['bdo'],
            'basesDestroyedPvp'             => @$item['bdpvp'],
            'basesDestroyedPve'             => @$item['bdpve'],
            'basesDestroyedOverallRanking'  => @$item['bdor'],
            'basesDestroyedPvpRanking'      => @$item['bdpvpr'],
            'basesDestroyedPveRanking'      => @$item['bdpver'],
            'dateTimestamp'                 => $item['date'],
            'date'                          => date('Y-m-d', $item['date'])
        );
    }

    public function alliancesHistoryToArray($cursor) {
        $items = array();
        
        foreach ($cursor as $item) {
            $items[] = $this->allianceHistoryToArray($item);
        }
        
        return $items;
    }

    public function allianceHistoryToArray($item) {
        return array(
            'externalId'                    => $item['exid'],
            'name'                          => $item['n'],
            'nameShort'                     => @$item['ns'],
            'membersCount'                  => $item['mc'],
            'membersBasesCount'             => $item['mbc'],
            'scoreOverall'                  => $item['so'],
            'scoreRanking'                  => $item['sor'],
            'scoreTop'                      => $item['st'],
            'scoreTopRanking'               => $item['str'],
            'scoreAverage'                  => $item['sa'],
            'scoreAverageRanking'           => $item['sar'],
            'distanceAverage'               => @$item['da'],
            'distanceAverageRanking'        => @$item['dar'],
            'distanceBest'                  => @$item['db'],
            'distanceWorst'                 => @$item['dw'],
            'basesDestroyedOverall'         => @$item['bdo'],
            'basesDestroyedPvp'             => @$item['bdpvp'],
            'basesDestroyedPve'             => @$item['bdpve'],
            'basesDestroyedOverallRanking'  => @$item['bdor'],
            'basesDestroyedPvpRanking'      => @$item['bdpvpr'],
            'basesDestroyedPveRanking'      => @$item['bdpver'],
            'dateTimestamp'                 => $item['date'],
            'date'                          => date('Y-m-d', $item['date'])
        );
    }

    public function basesHistoryToArray($cursor) {
        $items = array();
        
        foreach ($cursor as $item) {
            $items[] = $this->baseHistoryToArray($item);
        }
        
        return $items;
    }

    public function baseHistoryToArray($item) {
        return array(
            'externalId'                    => $item['exid'],
            'score'                         => $item['s'],
            'scoreRanking'                  => $item['sr'],
            'distanceCurrent'               => $item['dc'],
            'distanceRanking'               => $item['dcr'],
            'dateTimestamp'                 => $item['date'],
            'date'                          => date('Y-m-d', $item['date']),
            'x'                             => $item['x'],
            'y'                             => $item['y']
        );
    }

    public function basesToArray($cursor) {
        $items = array();
        
        foreach ($cursor as $item) {
            $items[$item['exid']] = $this->baseToArray($item);
        }
        
        return $items;
    }

    public function baseToArray($item) {
        return array(
            'externalId'                    => $item['exid'],
            'playerId'                      => $item['pid'],
            'name'                          => $item['n'],
            'creationDate'                  => date('Y-m-d', $item['cdate'])
        );
    }

    public function poisToArray($cursor) {
        $items = array();

        foreach ($cursor as $item) {
            $items[] = $this->poiToArray($item);
        }

        return $items;
    }

    public function poiToArray($item) {
        return array(
            'allianceId'                    => $item['aid'],
            'x'                             => $item['x'],
            'y'                             => $item['y'],
            'level'                         => $item['l'],
            'points'                        => $item['p'],
            'distance'                      => @$item['d'],
            'type'                          => @$item['t']
        );
    }

    public function arrayColumn($array, $column) {
        $results = array();
        
        foreach ($array as $item) {
            if (isset($item[$column]) && $item[$column] !== null) {
                $results[] = $item[$column];
            }
        }
        
        return $results;
    }
}