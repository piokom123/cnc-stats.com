<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SaadTazi\GChartBundle\DataTable;

class CompareController extends Controller {
    public function indexAction() {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        return $this->render('HwsCncstatsBundle:Compare:index.html.twig', array(
            'world'	=> $world
        ));
    }

    public function compareAlliancesAction($firstId, $secondId, $slug, $date) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = strtotime($date);

            if ($date > strtotime(date('Y-m-d'))) {
                return $this->forward('HwsCncstatsBundle:Compare:index', array(
                    'world'         => $world['externalId']
                ));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        $firstId = (int) $firstId;
        $secondId = (int) $secondId;
        
        $alliances = $em->getAlliances(array($firstId, $secondId));
        if (!is_array($alliances) || empty($alliances[$firstId]) || empty($alliances[$secondId])) {
            return $this->forward('HwsCncstatsBundle:Compare:index', array(
                'world'         => $world['externalId']
            ));
        }

        $firstAlliance = $alliances[$firstId];
        $secondAlliance = $alliances[$secondId];

        $collection = $em->getMongoCollection('alliancesHistory');

        $firstItem = $collection->findOne(array('_id' => $date.'_'.$firstId));

        if ($firstItem == null) {
            return $this->render('HwsCncstatsBundle:Compare:404.html.twig', array(
                'firstBasic'    => $firstAlliance,
                'secondBasic'   => $secondAlliance,
                'world'         => $world,
                'selectedDate'  => $date,
                'showDatePanel' => true,
                'baseUrl'       => $this->get('url')->getBaseUrl(true)
            ));
        }
        
        $firstItem = $dto->allianceHistoryToArray($firstItem);

        $secondItem = $collection->findOne(array('_id' => $date.'_'.$secondId));

        if ($secondItem == null) {
            return $this->render('HwsCncstatsBundle:Compare:404.html.twig', array(
                'firstBasic'    => $firstAlliance,
                'secondBasic'   => $secondAlliance,
                'world'         => $world,
                'selectedDate'  => $date,
                'showDatePanel' => true,
                'baseUrl'       => $this->get('url')->getBaseUrl(true)
            ));
        }
        
        $secondItem = $dto->allianceHistoryToArray($secondItem);

        return $this->render('HwsCncstatsBundle:Compare:alliances.html.twig', array(
            'firstBasic'    => $firstAlliance,
            'secondBasic'   => $secondAlliance,
            'firstItem'     => $firstItem,
            'secondItem'	=> $secondItem,
            'world'         => $world,
            'firstScore'	=> 0,
            'secondScore'	=> 0,
            'slug'          => $slug,
            'currentUrl'    => 'http://'.$_SERVER['HTTP_HOST'].'/world/'.$world['externalId'].'/compare/players/'.$firstId.'-'.$secondId.'/'.$slug,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
        ));
    }

    public function compareAlliancesChartsAction($firstId, $secondId, $slug, $dateFrom) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (null == $dateFrom || date('Y-m-d') === $dateFrom) {
            $dateFrom = date('Y-m-d', strtotime('-30 days'));
        }

        $dateFrom = strtotime($dateFrom);

        if ($dateFrom > strtotime(date('Y-m-d'))) {
                return $this->forward('HwsCncstatsBundle:Compare:index', array(
                    'world'         => $world['externalId']
                ));
        }

        $dateFrom = date('Y-m-d', $dateFrom);

        $em = $this->get('query');
        $dto = $this->get('dto');

        $firstId = (int) $firstId;
        $secondId = (int) $secondId;

        $alliances = $em->getAlliances(array($firstId, $secondId));
        if (!is_array($alliances) || empty($alliances[$firstId]) || empty($alliances[$secondId])) {
            return $this->forward('HwsCncstatsBundle:Compare:index', array(
                'world'         => $world['externalId']
            ));
        }

        $firstItem = $alliances[$firstId];
        $secondItem = $alliances[$secondId];

        $collection = $em->getMongoCollection('alliancesHistory');

        $firstAllianceStats = $collection->find(array('exid' => $firstId, 'date' => array('$gte' => strtotime($dateFrom))))->sort(array('date' => 1))->limit(30);
        $secondAllianceStats = $collection->find(array('exid' => $secondId, 'date' => array('$gte' => strtotime($dateFrom))))->sort(array('date' => 1))->limit(30);

        if ($firstAllianceStats->count() === 0 || $secondAllianceStats->count() === 0) {
            return $this->render('HwsCncstatsBundle:Compare:404.html.twig', array(
                'firstBasic'    => $firstItem,
                'secondBasic'   => $secondItem,
                'world'         => $world,
                'selectedDate'  => $dateFrom,
                'showDatePanel' => true,
                'baseUrl'       => $this->get('url')->getBaseUrl(true)
            ));
        }

        $firstAllianceStats = $dto->alliancesHistoryToArray($firstAllianceStats);
        $secondAllianceStats = $dto->alliancesHistoryToArray($secondAllianceStats);
        
        $firstItemDoc = $firstAllianceStats[0];
        $secondItemDoc = $secondAllianceStats[0];

        $rows = array();
        $dates = array();
        foreach ($firstAllianceStats as $item) {
            $dates[] = $item['date'];
            $rows['scoreRanking'][$item['date']][0]             = $item['scoreRanking'];
            $rows['scoreOverall'][$item['date']][0]             = $item['scoreOverall'];
            $rows['scoreTop'][$item['date']][0]                 = $item['scoreTop'];
            $rows['scoreAverage'][$item['date']][0]             = $item['scoreAverage'];
            $rows['membersBasesCount'][$item['date']][0]        = $item['membersBasesCount'];
            if ($world['login'] != '') {
                $rows['basesDestroyedOverall'][$item['date']][0]    = $item['basesDestroyedOverall'];
                $rows['basesDestroyedPvp'][$item['date']][0]        = $item['basesDestroyedPvp'];
                $rows['basesDestroyedPve'][$item['date']][0]        = $item['basesDestroyedPve'];
            }
        }
        foreach ($secondAllianceStats as $item) {
            $dates[] = $item['date'];
            $rows['scoreRanking'][$item['date']][1]             = $item['scoreRanking'];
            $rows['scoreOverall'][$item['date']][1]             = $item['scoreOverall'];
            $rows['scoreTop'][$item['date']][1]                 = $item['scoreTop'];
            $rows['scoreAverage'][$item['date']][1]             = $item['scoreAverage'];
            $rows['membersBasesCount'][$item['date']][1]        = $item['membersBasesCount'];
            if ($world['login'] != '') {
                $rows['basesDestroyedOverall'][$item['date']][1]    = $item['basesDestroyedOverall'];
                $rows['basesDestroyedPvp'][$item['date']][1]        = $item['basesDestroyedPvp'];
                $rows['basesDestroyedPve'][$item['date']][1]        = $item['basesDestroyedPve'];
            }
        }
        
        $dates = array_unique($dates);
        ksort($rows['scoreRanking']);
        ksort($rows['scoreOverall']);
        ksort($rows['scoreTop']);
        ksort($rows['scoreAverage']);
        ksort($rows['membersBasesCount']);
        
        $chart1 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' score ranking', $secondItem['name'].' score ranking', $dates, $rows['scoreRanking']);
        $chart2 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' score', $secondItem['name'].' score', $dates, $rows['scoreOverall']);
        $chart3 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' top 40 score', $secondItem['name'].' top 40 score', $dates, $rows['scoreTop']);
        $chart4 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' average score', $secondItem['name'].' average score', $dates, $rows['scoreAverage']);
        $chart5 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' members bases count', $secondItem['name'].' members bases count', $dates, $rows['membersBasesCount']);

        if ($world['login'] != '') {
            ksort($rows['basesDestroyedOverall']);
            ksort($rows['basesDestroyedPvp']);
            ksort($rows['basesDestroyedPve']);

            $chart6 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' all destroyed bases', $secondItem['name'].' all destroyed bases', $dates, $rows['basesDestroyedOverall']);
            $chart7 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' destroyed PVP', $secondItem['name'].' destroyed PVP', $dates, $rows['basesDestroyedPvp']);
            $chart8 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' destroyed PVE', $secondItem['name'].' destroyed PVE', $dates, $rows['basesDestroyedPve']);
        }

	    $data = array(
            'firstItem'     => $firstItemDoc,
            'secondItem'	=> $secondItemDoc,
            'world'         => $world,
            'slug'          => $slug,
            'chart1'        => $chart1,
            'chart2'        => $chart2,
            'chart3'        => $chart3,
            'chart4'        => $chart4,
            'chart5'        => $chart5,
            'selectedDate'  => $dateFrom,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
	    );

	    if ($world['login'] != '') {
            $data = array_merge($data, array(
                'chart6'	=> $chart6,
                'chart7'	=> $chart7,
                'chart8'	=> $chart8
            ));
	    }

	    return $this->render('HwsCncstatsBundle:Compare:alliances_charts.html.twig', $data);
    }

    public function comparePlayersAction($firstId, $secondId, $slug, $date) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = strtotime($date);

            if ($date > strtotime(date('Y-m-d'))) {
                return $this->forward('HwsCncstatsBundle:Compare:index', array(
                    'world'         => $world['externalId']
                ));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        $firstId = (int) $firstId;
        $secondId = (int) $secondId;
        
        $players = $em->getPlayers(array($firstId, $secondId));
        if (!is_array($players) || empty($players[$firstId]) || empty($players[$secondId])) {
            return $this->forward('HwsCncstatsBundle:Compare:index', array(
                'world'         => $world['externalId']
            ));
        }

        $firstPlayer = $players[$firstId];
        $secondPlayer = $players[$secondId];

        $collection = $em->getMongoCollection('playersHistory');

        $firstItem = $collection->findOne(array('_id' => $date.'_'.$firstId));
        
        if ($firstItem == null) {
            return $this->render('HwsCncstatsBundle:Compare:404.html.twig', array(
                'firstBasic'    => $firstPlayer,
                'secondBasic'   => $secondPlayer,
                'world'         => $world,
                'selectedDate'  => $date,
                'showDatePanel' => true,
                'baseUrl'       => $this->get('url')->getBaseUrl(true)
            ));
        }
        
        $firstItem = $dto->playerHistoryToArray($firstItem);

        $secondItem = $collection->findOne(array('_id' => $date.'_'.$secondId));
        
        if ($secondItem == null) {
            return $this->render('HwsCncstatsBundle:Compare:404.html.twig', array(
                'firstBasic'    => $firstPlayer,
                'secondBasic'   => $secondPlayer,
                'world'         => $world,
                'selectedDate'  => $date,
                'showDatePanel' => true,
                'baseUrl'       => $this->get('url')->getBaseUrl(true)
            ));
        }
        
        $secondItem = $dto->playerHistoryToArray($secondItem);
 
        $alliances = $em->getAlliances(array($firstItem['allianceId'], $secondItem['allianceId']));

        return $this->render('HwsCncstatsBundle:Compare:players.html.twig', array(
            'firstBasic'    => $firstPlayer,
            'secondBasic'   => $secondPlayer,
            'firstItem'     => $firstItem,
            'secondItem'	=> $secondItem,
            'world'         => $world,
            'alliances'     => $alliances,
            'firstScore'	=> 0,
            'secondScore'	=> 0,
            'slug'          => $slug,
            'currentUrl'    => 'http://'.$_SERVER['HTTP_HOST'].'/world/'.$world['externalId'].'/compare/players/'.$firstId.'-'.$secondId.'/'.$slug,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
        ));
    }

    public function comparePlayersChartsAction($firstId, $secondId, $slug, $dateFrom) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (null == $dateFrom || date('Y-m-d') === $dateFrom) {
            $dateFrom = date('Y-m-d', strtotime('-30 days'));
        }

        $dateFrom = strtotime($dateFrom);

        if ($dateFrom > strtotime(date('Y-m-d'))) {
                return $this->forward('HwsCncstatsBundle:Compare:index', array(
                    'world'         => $world['externalId']
                ));
        }

        $dateFrom = date('Y-m-d', $dateFrom);

        $em = $this->get('query');
        $dto = $this->get('dto');

        $firstId = (int) $firstId;
        $secondId = (int) $secondId;

        $players = $em->getPlayers(array($firstId, $secondId));
        if (!is_array($players) || empty($players[$firstId]) || empty($players[$secondId])) {
            return $this->forward('HwsCncstatsBundle:Compare:index', array(
                'world'         => $world['externalId']
            ));
        }

        $firstItem = $players[$firstId];
        $secondItem = $players[$secondId];

        $collection = $em->getMongoCollection('playersHistory');

        $firstPlayerStats = $collection->find(array('exid' => $firstId, 'date' => array('$gte' => strtotime($dateFrom))))->sort(array('date' => 1))->limit(30);
        $secondPlayerStats = $collection->find(array('exid' => $secondId, 'date' => array('$gte' => strtotime($dateFrom))))->sort(array('date' => 1))->limit(30);

        if ($firstPlayerStats->count() === 0 || $secondPlayerStats->count() === 0) {
            return $this->render('HwsCncstatsBundle:Compare:404.html.twig', array(
                'firstBasic'    => $firstItem,
                'secondBasic'   => $secondItem,
                'world'         => $world,
                'selectedDate'  => $dateFrom,
                'showDatePanel' => true,
                'baseUrl'       => $this->get('url')->getBaseUrl(true)
            ));
        }

        $secondPlayerStats = $dto->playersHistoryToArray($secondPlayerStats);
        $firstPlayerStats = $dto->playersHistoryToArray($firstPlayerStats);

        $rows = array();
        $dates = array();
        foreach ($firstPlayerStats as $item) {
            $dates[] = $item['date'];
            $rows['scoreRanking'][$item['date']][0]             = $item['scoreRanking'];
            $rows['scoreOverall'][$item['date']][0]             = $item['scoreOverall'];
            $rows['basesCount'][$item['date']][0]               = $item['basesCount'];
            if ($world['login'] != '') {
                $rows['basesDestroyedOverall'][$item['date']][0]    = $item['basesDestroyedOverall'];
                $rows['basesDestroyedPvp'][$item['date']][0]        = $item['basesDestroyedPvp'];
                $rows['basesDestroyedPve'][$item['date']][0]        = $item['basesDestroyedPve'];
            }
        }
        foreach ($secondPlayerStats as $item) {
            $dates[] = $item['date'];
            $rows['scoreRanking'][$item['date']][1]             = $item['scoreRanking'];
            $rows['scoreOverall'][$item['date']][1]             = $item['scoreOverall'];
            $rows['basesCount'][$item['date']][1]               = $item['basesCount'];
            if ($world['login'] != '') {
                $rows['basesDestroyedOverall'][$item['date']][1]    = $item['basesDestroyedOverall'];
                $rows['basesDestroyedPvp'][$item['date']][1]        = $item['basesDestroyedPvp'];
                $rows['basesDestroyedPve'][$item['date']][1]        = $item['basesDestroyedPve'];
            }
        }
        
        $dates = array_unique($dates);
        ksort($rows['scoreRanking']);
        ksort($rows['scoreOverall']);
        ksort($rows['basesCount']);
        
        $chart1 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' score ranking', $secondItem['name'].' score ranking', $dates, $rows['scoreRanking']);
        $chart2 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' score', $secondItem['name'].' score', $dates, $rows['scoreOverall']);
        $chart3 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' bases count', $secondItem['name'].' bases count', $dates, $rows['basesCount']);

        if ($world['login'] != '') {
            ksort($rows['basesDestroyedOverall']);
            ksort($rows['basesDestroyedPvp']);
            ksort($rows['basesDestroyedPve']);

            $chart4 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' all destroyed bases', $secondItem['name'].' all destroyed bases', $dates, $rows['basesDestroyedOverall']);
            $chart5 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' destroyed PVP', $secondItem['name'].' destroyed PVP', $dates, $rows['basesDestroyedPvp']);
            $chart6 = $this->get('chart_service')->generateCompareDataTableArray($firstItem['name'].' destroyed PVE', $secondItem['name'].' destroyed PVE', $dates, $rows['basesDestroyedPve']);
        }

	    $data = array(
            'firstBasic'    => $firstItem,
            'secondBasic'	=> $secondItem,
            'world'         => $world,
            'slug'          => $slug,
            'chart1'        => $chart1,
            'chart2'        => $chart2,
            'chart3'        => $chart3,
            'selectedDate'  => $dateFrom,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
	    );

	    if ($world['login'] != '') {
            $data = array_merge($data, array(
                'chart4'	=> $chart4,
                'chart5'	=> $chart5,
                'chart6'	=> $chart6
            ));
	    }

	    return $this->render('HwsCncstatsBundle:Compare:players_charts.html.twig', $data);
    }
}
