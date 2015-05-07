<?php

namespace Hws\CncstatsBundle\Service;

class AccessService {
    private $em;
    
    public function __construct($em) {
        $this->em = $em;
    }

    public function canAccess($worldId, $externalId, $type) {
        if ($type == 'alliance') {
            $type = 1;
        } else if ($type == 'player') {
            $type = 2;
        }

        $result = $this->em->createQuery('default', '
            SELECT
                a.id AS id
            FROM HwsCncstatsBundle:Block a
            WHERE a.world_id = :world_id
                AND a.external_id = :external_id
                AND a.type = :type
        ')
            ->setParameter('world_id', $worldId)
            ->setParameter('external_id', $externalId)
            ->setParameter('type', $type)
            ->getOneOrNullResult();

        if ($result == null) {
            return true;
        } else {
            return false;
        }
    }
}
