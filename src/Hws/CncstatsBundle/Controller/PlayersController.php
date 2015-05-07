<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SaadTazi\GChartBundle\DataTable;

class PlayersController extends Controller {
    public function indexAction($type, $date, $sort, $page) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = strtotime($date);

            if ($date > strtotime(date('Y-m-d'))) {
                $this->get('request')->getSession()->setFlash('notice', "Sorry, currently we can't show you statistics from future.\nInstead check out data from today.");
                return $this->redirect($this->generateUrl('players_world_type', array(
                    'type'	    => $type,
                    'world'     => $world['externalId']
                )));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');
        
        $queryConditions = array('date' => strtotime($date));

        if ($sort == 'distanceRanking') {
            $sortColumn = 'dr';
            $queryConditions['dc'] = array('$ne' => null);
        } else if ($sort == 'destroyedRanking') {
            $sortColumn = 'bdor';
            $queryConditions['bdor'] = array('$gt' => 0);
        } else if ($sort == 'pvpRanking') {
            $sortColumn = 'bdpvpr';
            $queryConditions['bdpvpr'] = array('$gt' => 0);
        } else if ($sort == 'pveRanking') {
            $sortColumn = 'bdpver';
            $queryConditions['bdpver'] = array('$gt' => 0);
        } else {
            $sortColumn = 'sor';
        }

        $collection = $em->getMongoCollection('playersHistory');

        $itemsCount = $collection->count($queryConditions);
        if ($itemsCount == 0) {
            if ($date == date('Y-m-d')) {
                $this->get('request')->getSession()->setFlash('notice', "There are no statistics for today yet. Please check again later.\nShowing newest found.");
            } else {
                $this->get('request')->getSession()->setFlash('notice', "There are no statistics for selected day.\nShowing newest found.");
            }

            $latestDate = $collection->find()->sort(array('date' => -1))->limit(1);
            $latestDate = $dto->playersHistoryToArray($latestDate);
            if (isset($latestDate[0])) {
                $latestDate = $latestDate[0]['date'];
            } else {
                $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
                return $this->redirect($this->generateUrl('world_id', array(
                    'world'     => $world['externalId']
                )));
            }

            return $this->redirect($this->generateUrl('players_world_type_date', array(
                'world'     => $world['externalId'],
                'type'	    => $type,
                'date'      => $latestDate
            )));
        }

        $items = $collection->find($queryConditions)->sort(array($sortColumn => 1))->skip(($page - 1) * 100)->limit(100);
        $items = $dto->playersHistoryToArray($items);

        $playersIds = $dto->arrayColumn($items, 'externalId');
        $players = $em->getPlayers($playersIds);

        $alliancesIds = $dto->arrayColumn($items, 'allianceId');
        $alliances = $em->getAlliances($alliancesIds);


        return $this->render($type == 'destroyed' ? 'HwsCncstatsBundle:Players:list_destroyed.html.twig' : 'HwsCncstatsBundle:Players:list_default.html.twig', array(
            'items'	=> $items,
            'players'   => $players,
            'alliances' => $alliances,
            'world'	=> $world,
            'selectedDate'  => $date,
            'sortedBy'  => $sort,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true),
            'pagination'    => $this->get('pager')->getPagerData($page, $itemsCount, 100, $this->get('url')->getBaseUrl(false, true))
        ));
    }

    public function playerAction($externalId, $date) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (!$this->get('access')->canAccess($world['externalId'], $externalId, 'player')) {
            return $this->redirect($this->generateUrl('blocked', array(
                'world'     => $world['externalId']
            )), 301);
        }

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = strtotime($date);

            if ($date > strtotime(date('Y-m-d'))) {
                $this->get('request')->getSession()->setFlash('notice', "Sorry, currently we can't show you statistics from future.\nInstead check out data from today.");
                return $this->redirect($this->generateUrl('player_world_externalId', array(
                    'world'     => $world['externalId'],
                    'externalId'    => $externalId
                )));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        $player = $em->getPlayers(array((int) $externalId));
        if (!is_array($player) || empty($player)) {
            $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
            return $this->redirect($this->generateUrl('world_id', array(
                'world'     => $world['externalId']
            )));
        }

        $player = $player[$externalId];

        $collection = $em->getMongoCollection('playersHistory');

        $item = $collection->findOne(array('_id' => $date.'_'.$externalId));
        
        if ($item == null) {
            if ($date == date('Y-m-d')) {
                return $this->forward('HwsCncstatsBundle:Default:index');
            } else {
                return $this->forward('HwsCncstatsBundle:Players:player', array(
                        'world'   => $world['externalId'],
                        'externalId' => $externalId,
                        'date'  => date('Y-m-d')
                ));
            }
        }
        
        $item = $dto->playerHistoryToArray($item);
 
        $alliance = $em->getAlliances(array($item['allianceId']));
        $alliance = $alliance[$item['allianceId']];
        
        $bases = $em->getMongoCollection('bases')->find(array('pid' => (int) $externalId));
        $bases = $dto->basesToArray($bases);

        $basesHistoryIds = array();
        foreach ($bases as $base) {
            $basesHistoryIds[] = $date.'_'.$base['externalId'];
        }

        $basesHistory = $em->getMongoCollection('basesHistory')->find(array('_id' => array('$in' => $basesHistoryIds)));
        $basesHistory = $dto->basesHistoryToArray($basesHistory);
        
        // player alliances changes
        $alliancesChangesCacheKey = 'plAlliaChanges_w'.$world['id'].'_exid'.$externalId;
        $alliancesChanges = $this->get('memcache.default')->get($alliancesChangesCacheKey);
        if ($alliancesChanges === false) {
            $alliancesChanges = array();
            $playerHistory = $em->getMongoCollection('playersHistory')->find(array('exid' => (int) $externalId))->limit(30 * 12);
            $playerHistory = $dto->playersHistoryToArray($playerHistory);
            $tmpLastAlliance = null;
            $tmpUniqueAlliancesIds = array('0');
            
            foreach ($playerHistory as $playerHistoryRow) {
                if ($playerHistoryRow['allianceId'] != $tmpLastAlliance) {
                    $alliancesChanges[] = array(
                        'oldAid'    => $tmpLastAlliance === null ? 0 : $tmpLastAlliance,
                        'newAid'    => $playerHistoryRow['allianceId'] === null ? 0 : $playerHistoryRow['allianceId'],
                        'date'      => $playerHistoryRow['date']
                    );

                    $tmpLastAlliance = $playerHistoryRow['allianceId'];

                    $tmpUniqueAlliancesIds[] = $tmpLastAlliance;
                }
            }

            $tmpUniqueAlliancesIds = array_unique($tmpUniqueAlliancesIds);
            
            $tmpUniqueAlliances = $em->getAlliances($tmpUniqueAlliancesIds);

            foreach ($alliancesChanges as $key => $value) {
                $alliancesChanges[$key]['oldName'] = $tmpUniqueAlliances[$alliancesChanges[$key]['oldAid']]['name'];
                $alliancesChanges[$key]['oldNameShort'] = $tmpUniqueAlliances[$alliancesChanges[$key]['oldAid']]['nameShort'];
                $alliancesChanges[$key]['newName'] = $tmpUniqueAlliances[$alliancesChanges[$key]['newAid']]['name'];
                $alliancesChanges[$key]['newNameShort'] = $tmpUniqueAlliances[$alliancesChanges[$key]['newAid']]['nameShort'];
            }

            $alliancesChanges = array_reverse($alliancesChanges);

            $this->get('memcache.default')->set($alliancesChangesCacheKey, $alliancesChanges, 60 * 60 * 24);
        }

        return $this->render('HwsCncstatsBundle:Players:player.html.twig', array(
            'item'		    => $item,
            'player'        => $player,
            'alliancesChanges' => $alliancesChanges,
            'alliance'      => $alliance,
            'bases'         => $bases,
            'basesHistory'  => $basesHistory,
            'world'		    => $world,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
        ));
    }

    public function scoreAction($externalId, $dateFrom) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (!$this->get('access')->canAccess($world['externalId'], $externalId, 'player')) {
            return $this->redirect($this->generateUrl('blocked', array(
                'world'     => $world['externalId']
            )), 301);
        }

        if (null == $dateFrom || date('Y-m-d') === $dateFrom) {
            $dateFrom = date('Y-m-d', strtotime('-30 days'));
        }

        $dateFrom = strtotime($dateFrom);

        if ($dateFrom > strtotime(date('Y-m-d'))) {
            $this->get('request')->getSession()->setFlash('notice', "Sorry, currently we can't show you statistics from future.\nInstead check out data from today.");
            return $this->redirect($this->generateUrl('player_world_externalId', array(
                'world'     => $world['externalId'],
                'externalId'    => $externalId
            )));
        }

        $dateFrom = date('Y-m-d', $dateFrom);

        $em    = $this->get('query');
        $dto = $this->get('dto');

        $player = $em->getPlayers(array((int) $externalId));
        if (!is_array($player) || empty($player)) {
            $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
            return $this->redirect($this->generateUrl('world_id', array(
                'world'     => $world['externalId']
            )));
        }

        $player = $player[$externalId];

        $collection = $em->getMongoCollection('playersHistory');

        $items = $collection->find(array('exid' => (int) $externalId, 'date' => array('$gte' => strtotime($dateFrom))))->sort(array('date' => 1))->limit(30);
        $items = $dto->playersHistoryToArray($items);

        $rows = array(
            'ranking'   => array(),
            'score'	    => array()
        );

        $chart1 = null;
        $chart2 = null;

        if (count($items) > 0) {
            foreach($items as $item) {
                $rows['ranking']['rowsTitles'][] = $item['date'];
                $rows['ranking']['rowsValues'][] = (int) $item['scoreRanking'];

                $rows['score']['rowsTitles'][] = $item['date'];
                $rows['score']['rowsValues'][] = (int) $item['scoreOverall'];
            }

            $chart1 = $this->get('chart_service')->generateDataTableArray('Ranking', $rows['ranking']['rowsTitles'], $rows['ranking']['rowsValues']);
            $chart2 = $this->get('chart_service')->generateDataTableArray('Score', $rows['score']['rowsTitles'], $rows['score']['rowsValues']);
        }

        return $this->render('HwsCncstatsBundle:Players:score.html.twig', array(
            'player'	=> $player,
            'world'		=> $world,
            'chart1'	=> $chart1,
            'chart2'	=> $chart2,
            'selectedDate'  => $dateFrom,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
        ));
    }

    public function basesAction($externalId, $dateFrom) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (!$this->get('access')->canAccess($world['externalId'], $externalId, 'player')) {
            return $this->redirect($this->generateUrl('blocked', array(
                'world'     => $world['externalId']
            )), 301);
        }

        if (null == $dateFrom || date('Y-m-d') === $dateFrom) {
            $dateFrom = date('Y-m-d', strtotime('-30 days'));
        }

        $dateFrom = strtotime($dateFrom);

        if ($dateFrom > strtotime(date('Y-m-d'))) {
            $this->get('request')->getSession()->setFlash('notice', "Sorry, currently we can't show you statistics from future.\nInstead check out data from today.");
            return $this->redirect($this->generateUrl('player_world_externalId', array(
                'world'     => $world['externalId'],
                'externalId'    => $externalId
            )));
        }

        $dateFrom = date('Y-m-d', $dateFrom);

        $em    = $this->get('query');
        $dto = $this->get('dto');

        $player = $em->getPlayers(array((int) $externalId));
        if (!is_array($player) || empty($player)) {
            $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
            return $this->redirect($this->generateUrl('world_id', array(
                'world'     => $world['externalId']
            )));
        }

        $player = $player[$externalId];

        $collection = $em->getMongoCollection('playersHistory');

        $items = $collection->find(array('exid' => (int) $externalId, 'date' => array('$gte' => strtotime($dateFrom))))->sort(array('date' => 1))->limit(30);
        $items = $dto->playersHistoryToArray($items);

	    $rows = array(
            'destroyed' => array(),
            'pvp'	    => array(),
            'pve'	    => array(),
            'bases'     => array()
	    );
        
        $chart1 = null;
        $chart2 = null;
        $chart3 = null;
        $chart4 = null;

        if (count($items) > 0) {
            foreach($items as $item) {
                $rows['destroyed']['rowsTitles'][] = $item['date'];
                $rows['destroyed']['rowsValues'][] = (int) $item['basesDestroyedOverall'];

                $rows['pvp']['rowsTitles'][] = $item['date'];
                $rows['pvp']['rowsValues'][] = (int) $item['basesDestroyedPvp'];

                $rows['pve']['rowsTitles'][] = $item['date'];
                $rows['pve']['rowsValues'][] = (int) $item['basesDestroyedPve'];

                $rows['bases']['rowsTitles'][] = $item['date'];
                $rows['bases']['rowsValues'][] = (int) $item['basesCount'];
            }

            $chart1 = $this->get('chart_service')->generateDataTableArray('Destroyed bases', $rows['destroyed']['rowsTitles'], $rows['destroyed']['rowsValues']);
            $chart2 = $this->get('chart_service')->generateDataTableArray('Destroyed bases', $rows['pvp']['rowsTitles'], $rows['pvp']['rowsValues']);
            $chart3 = $this->get('chart_service')->generateDataTableArray('Destroyed bases', $rows['pve']['rowsTitles'], $rows['pve']['rowsValues']);
            $chart4 = $this->get('chart_service')->generateDataTableArray('Bases', $rows['bases']['rowsTitles'], $rows['bases']['rowsValues']);
        }

	    return $this->render('HwsCncstatsBundle:Players:bases.html.twig', array(
            'player'	=> $player,
            'world'		=> $world,
            'chart1'	=> $chart1,
            'chart2'	=> $chart2,
            'chart3'	=> $chart3,
            'chart4'	=> $chart4,
            'selectedDate'  => $dateFrom,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
	    ));
    }

    public function rankingsAction($externalId) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (!$this->get('access')->canAccess($world['externalId'], $externalId, 'player')) {
            return $this->redirect($this->generateUrl('blocked', array(
                'world'     => $world['externalId']
            )), 301);
        }

        $em = $this->get('query');

        try {
            $item = $em->createQuery('world', 'SELECT a FROM HwsCncstatsBundle:Player a WHERE a.external_id = :external_id')->setParameter('external_id', $externalId)->getSingleResult();

                $rankingsTypesQuery = $em->createQuery('default', "SELECT a FROM HwsCncstatsBundle:RankingType a WHERE a.active = 1 AND a.type = 'player'")->getResult();

                $rankingsTypesIds = array();
                $rankingsTypes = array();
                foreach ($rankingsTypesQuery as $rankingsType) {
                    $rankingsTypesIds[] = $rankingsType->getId();
                    $rankingsTypes[$rankingsType->getId()] = $rankingsType;
                }
                $rankingsTypesIds = implode(', ', $rankingsTypesIds);

                $globalRankingsQuery = $em->createQuery('default', "
                    SELECT
                        m
                    FROM HwsCncstatsBundle:RankingMedal m
                    WHERE 
                        m.world_id = :world_id
                        AND m.item_type = 0
                        AND m.item_id = :player_id
                        AND m.type_id IN (".$rankingsTypesIds.")
                        AND m.is_global = 1
                        ORDER BY m.ranking ASC
                ")
                        ->setParameter('world_id', $world['id'])
                        ->setParameter('player_id', $item->getExternalId())
                        ->getResult();

                $globalRankings = array();
                foreach ($globalRankingsQuery as $globalRanking) {
                    if (array_key_exists($globalRanking->getTypeId(), $globalRankings)) {
                        $globalRankings[$globalRanking->getTypeId()][] = $globalRanking;
                    } else {
                        $globalRankings[$globalRanking->getTypeId()] = array($globalRanking);
                    }
                }

                $worldRankingsQuery = $em->createQuery('default', "
                    SELECT
                        m
                    FROM HwsCncstatsBundle:RankingMedal m
                    WHERE 
                        m.world_id = :world_id
                        AND m.item_type = 0
                        AND m.item_id = :player_id
                        AND m.type_id IN (".$rankingsTypesIds.")
                        AND m.is_global = 0
                        ORDER BY m.ranking ASC
                ")
                        ->setParameter('world_id', $world['id'])
                        ->setParameter('player_id', $item->getExternalId())
                        ->getResult();

                $worldRankings = array();
                foreach ($worldRankingsQuery as $worldRanking) {
                    if (array_key_exists($worldRanking->getTypeId(), $worldRankings)) {
                        $worldRankings[$worldRanking->getTypeId()][] = $worldRanking;
                    } else {
                        $worldRankings[$worldRanking->getTypeId()] = array($worldRanking);
                    }
                }

            return $this->render('HwsCncstatsBundle:Players:rankings.html.twig', array(
                'item'		    => $item,
                'world'		    => $world,
                'rankingsTypes'     => $rankingsTypes,
                'globalRankings'    => $globalRankings,
                'worldRankings'    => $worldRankings
            ));
        } catch (\Doctrine\Orm\NoResultException $e) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }
    }
}
