<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlliancesController extends Controller {
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
                return $this->redirect($this->generateUrl('alliances_world_type', array(
                    'type'	    => $type,
                    'world'     => $world['externalId']
                )));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        if ($sort == 'distanceAverageRanking') {
            $sortColumn = 'dar';
        } else if ($sort == 'scoreAverageRanking') {
            $sortColumn = 'sar';
        } else if ($sort == 'scoreTopRanking') {
            $sortColumn = 'str';
        } else if ($sort == 'destroyedRanking') {
            $sortColumn = 'bdor';
        } else if ($sort == 'pvpRanking') {
            $sortColumn = 'bdpvpr';
        } else if ($sort == 'pveRanking') {
            $sortColumn = 'bdpver';
        } else {
            $sortColumn = 'sor';
        }

        $collection = $em->getMongoCollection('alliancesHistory');

        $itemsCount = $collection->count(array('date' => strtotime($date)));
        if ($itemsCount == 0) {
            if ($date == date('Y-m-d')) {
                $this->get('request')->getSession()->setFlash('notice', "There are no statistics for today yet. Please check again later.\nShowing newest found.");
            } else {
                $this->get('request')->getSession()->setFlash('notice', "There are no statistics for selected day.\nShowing newest found.");
            }

            $latestDate = $collection->find()->sort(array('date' => -1))->limit(1);
            $latestDate = $dto->alliancesHistoryToArray($latestDate);
            if (isset($latestDate[0])) {
                $latestDate = $latestDate[0]['date'];
            } else {
                $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
                return $this->redirect($this->generateUrl('world_id', array(
                    'world'     => $world['externalId']
                )));
            }

            return $this->redirect($this->generateUrl('alliances_world_type_date', array(
                'world'     => $world['externalId'],
                'type'	    => $type,
                'date'      => $latestDate
            )));
        }

        $items = $collection->find(array('date' => strtotime($date)))->sort(array($sortColumn => 1))->skip(($page - 1) * 100)->limit(100);
        $items = $dto->alliancesHistoryToArray($items);

        $alliancesIds = $dto->arrayColumn($items, 'externalId');
        $alliances = $em->getAlliances($alliancesIds);

        return $this->render($type == 'destroyed' ? 'HwsCncstatsBundle:Alliances:list_destroyed.html.twig' : 'HwsCncstatsBundle:Alliances:list_default.html.twig', array(
            'items'	    => $items,
            'alliances' => $alliances,
            'world'	    => $world,
            'sortedBy'     => $sort,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true),
            'pagination'    => $this->get('pager')->getPagerData($page, $itemsCount, 100, $this->get('url')->getBaseUrl(false, true))
        ));
    }

    public function allianceAction($externalId, $date) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (!$this->get('access')->canAccess($world['externalId'], $externalId, 'alliance')) {
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
                return $this->redirect($this->generateUrl('alliance_world_externalId', array(
                    'world'     => $world['externalId'],
                    'externalId'    => $externalId
                )));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        $alliance = $em->getAlliances(array((int) $externalId));
        if (!is_array($alliance) || empty($alliance)) {
            $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
            return $this->redirect($this->generateUrl('world_id', array(
                'world'     => $world['externalId']
            )));
        }

        $alliance = $alliance[$externalId];

        $collection = $em->getMongoCollection('alliancesHistory');

        $item = $collection->findOne(array('_id' => $date.'_'.$externalId));

        if ($item != null) {
            $item = $dto->allianceHistoryToArray($item);
        } else {
            if ($date == date('Y-m-d')) {
                $this->get('request')->getSession()->setFlash('notice', "There are no statistics for today yet. Please check again later.\nShowing newest found.");
            } else {
                $this->get('request')->getSession()->setFlash('notice', "There are no statistics for selected day.\nShowing newest found.");
            }

            $latestDate = $collection->find(array('exid' => (int) $externalId))->sort(array('date' => -1))->limit(1);
            $latestDate = $dto->alliancesHistoryToArray($latestDate);
            if (isset($latestDate[0])) {
                $latestDate = $latestDate[0]['date'];
            } else {
                $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
                return $this->redirect($this->generateUrl('world_id', array(
                    'world'     => $world['externalId']
                )));
            }

            return $this->redirect($this->generateUrl('alliance_world_externalId_date', array(
                'world'         => $world['externalId'],
                'externalId'    => $externalId,
                'date'          => $latestDate
            )));
        }
 
        return $this->render('HwsCncstatsBundle:Alliances:alliance.html.twig', array(
            'item'		    => $item,
            'alliance'      => $alliance,
            'world'		    => $world,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
        ));
    }

    public function membersAction($externalId, $date) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (!$this->get('access')->canAccess($world['externalId'], $externalId, 'alliance')) {
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
                return $this->redirect($this->generateUrl('allianceMembers_world_externalId', array(
                    'world'     => $world['externalId'],
                    'externalId'    => $externalId
                )));
            }

            $date = date('Y-m-d', $date);
        }

        if ($externalId <= 0) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $em = $this->get('query');
        $dto = $this->get('dto');
        
        $alliance = $em->getAlliances(array((int) $externalId));
        if (!is_array($alliance) || empty($alliance)) {
            $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
            return $this->redirect($this->generateUrl('world_id', array(
                'world'     => $world['externalId']
            )));
        }

        $alliance = $alliance[$externalId];

        $collection = $em->getMongoCollection('alliancesHistory');

        $item = $collection->findOne(array('_id' => $date.'_'.$externalId));

        $collection = $em->getMongoCollection('playersHistory');

        $subItems = $collection->find(array('date' => strtotime($date), 'aid' => (int) $externalId))->limit(50);
        $subItems = $dto->playersHistoryToArray($subItems);

        $playersIds = $dto->arrayColumn($subItems, 'externalId');
        $players = $em->getPlayers($playersIds);

	    return $this->render('HwsCncstatsBundle:Alliances:members.html.twig', array(
            'item'	=> $alliance,
            'players'   => $players,
            'world'		=> $world,
            'members'	=> $subItems,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
	    ));
    }

    public function chartsAction($externalId, $dateFrom, $type) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (!$this->get('access')->canAccess($world['externalId'], $externalId, 'alliance')) {
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
            return $this->redirect($this->generateUrl('alliance_world_externalId', array(
                'world'     => $world['externalId'],
                'externalId'    => $externalId
            )));
        }

        $dateFrom = date('Y-m-d', $dateFrom);

        $em    = $this->get('query');
        $dto = $this->get('dto');

        $alliance = $em->getAlliances(array((int) $externalId));
        if (!is_array($alliance) || empty($alliance)) {
            $this->get('request')->getSession()->setFlash('notice', "There is no data to display.");
            return $this->redirect($this->generateUrl('world_id', array(
                'world'     => $world['externalId']
            )));
        }

        $alliance = $alliance[$externalId];

        $collection = $em->getMongoCollection('alliancesHistory');

        $items = $collection->find(array('exid' => (int) $externalId, 'date' => array('$gte' => strtotime($dateFrom))))->sort(array('date' => 1))->limit(30);
        $items = $dto->alliancesHistoryToArray($items);

        $chart1 = null;
        $chart2 = null;
        $chart3 = null;
        $chart4 = null;
        $chart5 = null;
        $chart6 = null;

        if (count($items) > 0) {
            if ($type === 'score') {
                $rows = array(
                    'ranking'               => array(),
                    'score'                 => array(),
                    'scoreAverage'          => array(),
                    'scoreAverageRanking'   => array(),
                    'scoreTop'              => array(),
                    'scoreTopRanking'       => array()
                );

                foreach($items as $item) {
                    $rows['ranking']['rowsTitles'][] = $item['date'];
                    $rows['ranking']['rowsValues'][] = (int) $item['scoreRanking'];

                    $rows['score']['rowsTitles'][] = $item['date'];
                    $rows['score']['rowsValues'][] = (int) $item['scoreOverall'];

                    $rows['scoreAverageRanking']['rowsTitles'][] = $item['date'];
                    $rows['scoreAverageRanking']['rowsValues'][] = (int) $item['scoreAverageRanking'];

                    $rows['scoreTopRanking']['rowsTitles'][] = $item['date'];
                    $rows['scoreTopRanking']['rowsValues'][] = (int) $item['scoreTopRanking'];

                    $rows['scoreAverage']['rowsTitles'][] = $item['date'];
                    $rows['scoreAverage']['rowsValues'][] = (int) $item['scoreAverage'];

                    $rows['scoreTop']['rowsTitles'][] = $item['date'];
                    $rows['scoreTop']['rowsValues'][] = (int) $item['scoreTop'];
                }

                $chart1 = $this->get('chart_service')->generateDataTableArray('Ranking', $rows['ranking']['rowsTitles'], $rows['ranking']['rowsValues']);
                $chart2 = $this->get('chart_service')->generateDataTableArray('Score', $rows['score']['rowsTitles'], $rows['score']['rowsValues']);
                $chart3 = $this->get('chart_service')->generateDataTableArray('Average score', $rows['scoreAverage']['rowsTitles'], $rows['scoreAverage']['rowsValues']);
                $chart4 = $this->get('chart_service')->generateDataTableArray('Average score ranking', $rows['scoreAverageRanking']['rowsTitles'], $rows['scoreAverageRanking']['rowsValues']);
                $chart5 = $this->get('chart_service')->generateDataTableArray('Top 40 score', $rows['scoreTop']['rowsTitles'], $rows['scoreTop']['rowsValues']);
                $chart6 = $this->get('chart_service')->generateDataTableArray('Top 40 score ranking', $rows['scoreTopRanking']['rowsTitles'], $rows['scoreTopRanking']['rowsValues']);
            } else {
                $rows = array(
                    'basesDestroyedOverall'     => array(),
                    'basesDestroyedPvp'         => array(),
                    'basesDestroyedPve'         => array(),
                    'membersCount'              => array(),
                    'membersBases'              => array()
                );

                foreach($items as $item) {
                    $rows['basesDestroyedOverall']['rowsTitles'][] = $item['date'];
                    $rows['basesDestroyedOverall']['rowsValues'][] = (int) $item['basesDestroyedOverall'];

                    $rows['basesDestroyedPvp']['rowsTitles'][] = $item['date'];
                    $rows['basesDestroyedPvp']['rowsValues'][] = (int) $item['basesDestroyedPvp'];

                    $rows['basesDestroyedPve']['rowsTitles'][] = $item['date'];
                    $rows['basesDestroyedPve']['rowsValues'][] = (int) $item['basesDestroyedPve'];

                    $rows['membersCount']['rowsTitles'][] = $item['date'];
                    $rows['membersCount']['rowsValues'][] = (int) $item['membersCount'];

                    $rows['membersBases']['rowsTitles'][] = $item['date'];
                    $rows['membersBases']['rowsValues'][] = (int) $item['membersBasesCount'];
                }

                $chart1 = $this->get('chart_service')->generateDataTableArray('Destroyed bases', $rows['basesDestroyedOverall']['rowsTitles'], $rows['basesDestroyedOverall']['rowsValues']);
                $chart2 = $this->get('chart_service')->generateDataTableArray('Destroyed bases', $rows['basesDestroyedPvp']['rowsTitles'], $rows['basesDestroyedPvp']['rowsValues']);
                $chart3 = $this->get('chart_service')->generateDataTableArray('Destroyed bases', $rows['basesDestroyedPve']['rowsTitles'], $rows['basesDestroyedPve']['rowsValues']);
                $chart4 = $this->get('chart_service')->generateDataTableArray('Members count', $rows['membersCount']['rowsTitles'], $rows['membersCount']['rowsValues']);
                $chart5 = $this->get('chart_service')->generateDataTableArray('Members bases', $rows['membersBases']['rowsTitles'], $rows['membersBases']['rowsValues']);
            }
        }

	    return $this->render($type == 'score' ? 'HwsCncstatsBundle:Alliances:score.html.twig' : 'HwsCncstatsBundle:Alliances:bases.html.twig', array(
            'alliance'	=> $alliance,
            'world'		=> $world,
            'chart1'	=> $chart1,
            'chart2'	=> $chart2,
            'chart3'	=> $chart3,
            'chart4'	=> $chart4,
            'chart5'	=> $chart5,
            'chart6'	=> $chart6,
            'selectedDate'  => $dateFrom,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
	    ));
    }
}
