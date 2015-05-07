<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PoisController extends Controller {
    public function indexAction($sort, $page) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $em = $this->get('query');
        $dto = $this->get('dto');

        if ($sort == 'distance') {
            $sortColumn = 'd';
            $sortType = 1;
        } else {
            $sortColumn = 'l';
            $sortType = -1;
        }

        $collection = $em->getMongoCollection('pois');

        $items = $collection->find()->sort(array($sortColumn => $sortType))->skip(($page - 1) * 100)->limit(100);
        $items = $dto->poisToArray($items);
        
        $itemsCount = $collection->count();
        
        $alliancesIds = $dto->arrayColumn($items, 'allianceId');
        $alliances = $em->getAlliances($alliancesIds);

        $typesQuery = $em->createQuery('default', 'SELECT
                a.name,
                a.type
            FROM HwsCncstatsBundle:PoiType a
        ')->getResult();

        $types = array();
        foreach ($typesQuery as $type) {
            $types[$type['type']] = $type['name'];
        }

        return $this->render('HwsCncstatsBundle:Pois:list.html.twig', array(
            'items'	=> $items,
            'types' => $types,
            'alliances' => $alliances,
            'sortedBy'  => $sort,
            'world'	=> $world,
            'pagination'    => $this->get('pager')->getPagerData($page, $itemsCount, 100, $this->get('url')->getBaseUrl(false, true))
        ));
    }
}
