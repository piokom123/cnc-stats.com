<?php

namespace Hws\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class PlayerController extends FOSRestController {
    public function getAction($world, $externalId) {
        $externalId = (int) $externalId;

        $result = array();
        $responseCode = 200;

        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            $result = array(
                'responseCode' => -401
            );

            $responseCode = 404;
        } else {
            $date = date('Y-m-d');
            
            $em = $this->get('query');
            $dto = $this->get('dto');

            $player = $em->getPlayers(array($externalId));
            if (!is_array($player) || empty($player)) {
                $result = array(
                    'responseCode' => -403
                );

                $responseCode = 404;
            } else {
                $player = $player[$externalId];
                $collection = $em->getMongoCollection('playersHistory');

                $item = $collection->findOne(array('_id' => $date.'_'.$externalId));
                
                if ($item == null) {
                    $latestDate = $collection->find(array('exid' => $externalId))->sort(array('date' => -1))->limit(1);
                    $latestDate = $dto->alliancesHistoryToArray($latestDate);
                    if (isset($latestDate[0])) {
                        $latestDate = $latestDate[0]['date'];
                        $item = $collection->findOne(array('_id' => $latestDate.'_'.$externalId));
                    } else {
                        $result = array(
                            'responseCode' => -402
                        );

                        $responseCode = 404;

                        $view = $this->view($result, $responseCode)->setFormat('json');

                        return $this->handleView($view);
                    }
                }
                
                $result = array('player' => $dto->playerHistoryToArray($item));
            }
        }

        $view = $this->view($result, $responseCode)->setFormat('json');

        return $this->handleView($view);
    }
}
