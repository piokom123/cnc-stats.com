<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {
    public function indexAction() {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $em = $this->get('query');
        return $this->render('HwsCncstatsBundle:Default:index.html.twig', array(
            'worlds'	=> $em->createQuery('default', 'SELECT a FROM HwsCncstatsBundle:World a WHERE a.do_show = 1 ORDER BY a.external_id ASC')->getResult(),
            'world'	=> $world,
            'newses'	=> $em->createQuery('default', 'SELECT a FROM HwsCncstatsBundle:News a ORDER BY a.date DESC')->setMaxResults(10)->getResult(),
            'sums'      => $em->createQuery('default', 'SELECT COUNT(a) as worlds, SUM(a.players) as players, SUM(a.alliances) as alliances FROM HwsCncstatsBundle:World a WHERE a.do_show = 1')->getResult()
        ));
    }

    public function worldAction() {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        try {
            $item = $em->createQuery('default', 'SELECT w FROM HwsCncstatsBundle:World w WHERE w.external_id = :externalId')->setParameter(':externalId', $world['externalId'])->getSingleResult();
        } catch (Exception $e) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $collection = $em->getMongoCollection('alliancesHistory');
        $alliances = $collection->find(array('date' => strtotime(date('Y-m-d'))))->sort(array('sor' => 1))->limit(5);
        $alliances = $dto->alliancesHistoryToArray($alliances);
        $alliancesIds = $dto->arrayColumn($alliances, 'externalId');
        $alliancesBasic = $em->getAlliances($alliancesIds);

        $collection = $em->getMongoCollection('playersHistory');
        $players = $collection->find(array('date' => strtotime(date('Y-m-d'))))->sort(array('sor' => 1))->limit(5);
        $players = $dto->playersHistoryToArray($players);
        $playersIds = $dto->arrayColumn($players, 'externalId');
        $playersBasic = $em->getPlayers($playersIds);

        return $this->render('HwsCncstatsBundle:Default:world.html.twig', array(
            'item'	=> $item,
            'world'	=> $world,
            'aliancesBasic' => $alliancesBasic,
             'alliances'    => $alliances,
            'playersBasic'  => $playersBasic,
            'players'   => $players
	    ));
    }

    public function errorAction($code) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $response = $this->render('HwsCncstatsBundle:Default:error.html.twig', array(
            'world'	=> $world,
            'backUrl'	=> isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/'
        ));

        if ($code !== 404) {
            $code = 500;
        }

        $response->setStatusCode($code);

        return $response;
    }

    public function thanksAction() {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        return $this->render('HwsCncstatsBundle:Default:thanks.html.twig', array(
            'world'	=> $world
        ));
    }

    public function advertsAction() {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        return $this->render('HwsCncstatsBundle:Default:adverts.html.twig', array(
            'world'	=> $world
        ));
    }

    public function availableworldsAction() {
        $defaultEm    = $this->get('query');

        $worlds = $defaultEm->createQuery('default', 'SELECT a FROM HwsCncstatsBundle:World a WHERE a.do_show = 1 ORDER BY a.external_id ASC')->getResult();

        $worldsJson = array();
        foreach ($worlds as $world) {
            $worldsJson[] = array(
                'externalId'	=> $world->getExternalId(),
                'name'		=> $world->getName()
            );
        }

        $worldsJson = json_encode($worldsJson);

        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-type', 'application/json');
        $response->send();

        return $this->render('HwsCncstatsBundle:Default:blank.json.twig', array(
            'json'	=> $worldsJson
        ));
    }

    public function blockedAction() {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        return $this->render('HwsCncstatsBundle:Default:blocked.html.twig', array(
            'world'	=> $world
        ));
    }
}