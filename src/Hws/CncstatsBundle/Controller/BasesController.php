<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BasesController extends Controller {
    public function indexAction($date, $sort, $page) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = strtotime($date);

            if ($date > strtotime(date('Y-m-d'))) {
                return $this->forward('HwsCncstatsBundle:Bases:index', array(
                    'world'     => $world['externalId'],
                    'date'      => date('Y-m-d'),
                    'sort'      => 'scoreRanking',
                    'page'      => 1
                ));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        if ($sort == 'distanceRanking') {
            $sortColumn = 'dcr';
        } else {
            $sortColumn = 'sr';
        }

        $collection = $em->getMongoCollection('basesHistory');
        
        $itemsCount = $collection->count(array('date' => strtotime($date)));
        if ($itemsCount == 0) {
            if ($date == date('Y-m-d')) {
                return $this->forward('HwsCncstatsBundle:Default:index');
            }

            return $this->forward('HwsCncstatsBundle:Bases:index', array(
                'world'     => $world['externalId'],
                'date'      => date('Y-m-d'),
                'sort'      => 'scoreRanking',
                'page'      => 1
            ));
        }

        $items = $collection->find(array('date' => strtotime($date)))->sort(array($sortColumn => 1))->skip(($page - 1) * 100)->limit(100);
        $items = $dto->basesHistoryToArray($items);

        $basesIds = $dto->arrayColumn($items, 'externalId');
        $bases = $em->getBases($basesIds);

        $playersIds = $dto->arrayColumn($bases, 'playerId');
        $players = $em->getPlayers($playersIds);

        return $this->render('HwsCncstatsBundle:Bases:list.html.twig', array(
            'items'	=> $items,
            'bases' => $bases,
            'players'   => $players,
            'world'	=> $world,
            'sortedBy'  => $sort,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true),
            'pagination'    => $this->get('pager')->getPagerData($page, $itemsCount, 100, $this->get('url')->getBaseUrl(false, true))
        ));
    }

    public function baseAction($externalId, $date) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if ($date == null) {
            $date = date('Y-m-d');
        } else {
            $date = strtotime($date);

            if ($date > strtotime(date('Y-m-d'))) {
                return $this->forward('HwsCncstatsBundle:Bases:index', array(
                    'world'     => $world['externalId'],
                    'date'      => date('Y-m-d'),
                    'sort'      => 'scoreRanking',
                    'page'      => 1
                ));
            }

            $date = date('Y-m-d', $date);
        }

        $em = $this->get('query');
        $dto = $this->get('dto');
        
        $base = $em->getBases(array((int) $externalId));
        if (!is_array($base) || empty($base)) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $base = $base[$externalId];

        $collection = $em->getMongoCollection('basesHistory');

        $item = $collection->findOne(array('_id' => $date.'_'.$externalId));
        
        if ($item == null) {
            if ($date == date('Y-m-d')) {
                return $this->forward('HwsCncstatsBundle:Default:index');
            } else {
                return $this->forward('HwsCncstatsBundle:Bases:base', array(
                        'world'   => $world['externalId'],
                        'externalId' => $externalId,
                        'date'  => date('Y-m-d')
                ));
            }
        }
        
        $item = $dto->baseHistoryToArray($item);

        $player = $em->getPlayers(array($base['playerId']));
        $player = $player[$base['playerId']];

	    return $this->render('HwsCncstatsBundle:Bases:base.html.twig', array(
            'item'		    => $item,
            'base'          => $base,
            'player'        => $player,
            'world'		    => $world,
            'selectedDate'  => $date,
            'showDatePanel' => true,
            'baseUrl'       => $this->get('url')->getBaseUrl(true)
	    ));
    }
}
