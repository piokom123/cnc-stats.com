<?php

namespace Hws\CncstatsBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Doctrine\ORM\NoResultException;

class WorldService {
    private $em;
    private $request;
    private $service;

    public function __construct($em, $request, $service) {
        $this->em = $em;
        $this->request = $request;
        $this->service = $service;
    }

    public function getWorld() {
        try {
            if($this->request->get('world') == null || $this->request->get('world') == false) {
                if($this->request->cookies->get('world') != false) {
                    $world = $this->em->createQuery('SELECT
                                    a.id as id,
                                    a.external_id as externalId,
                                    a.login as login,
                                    a.name as name,
                                    a.players as players,
                                    a.players_inactive7 as playersInactive7,
                                    a.alliances as alliances,
                                    a.bases as bases,
                                    a.bases_destroyed as basesDestroyed,
                                    a.pois as pois,
                                    a.pois as pois2,
                                    a.pois as pois3,
                                    a.pois as pois4,
                                    a.pois as pois5,
                                    a.pois as pois6,
                                    a.pois as pois7,
                                    a.pois as pois8,
                                    a.service_id as serviceId
                                FROM HwsCncstatsBundle:World a
                                WHERE a.external_id = :external_id
                                    AND a.do_show = 1')
                                    ->setParameter('external_id', (int) $this->request->cookies->get('world'))
                                    ->setMaxResults(1)
                                    ->useResultCache(true, 21600, 'world')
                                    ->getSingleResult();
                } else {
                    $world = $this->em->createQuery('SELECT
                                    a.id as id,
                                    a.external_id as externalId,
                                    a.login as login,
                                    a.name as name,
                                    a.players as players,
                                    a.players_inactive7 as playersInactive7,
                                    a.alliances as alliances,
                                    a.bases as bases,
                                    a.bases_destroyed as basesDestroyed,
                                    a.pois as pois,
                                    a.pois as pois2,
                                    a.pois as pois3,
                                    a.pois as pois4,
                                    a.pois as pois5,
                                    a.pois as pois6,
                                    a.pois as pois7,
                                    a.pois as pois8,
                                    a.service_id as serviceId
                                FROM HwsCncstatsBundle:World a
                                WHERE a.do_show = 1
                                ORDER BY a.id')
                                    ->setMaxResults(1)
                                    ->useResultCache(true, 21600, 'worlds')
                                    ->getSingleResult();
                }
            } else {
                if ($this->request->cookies->get('world') === false) {
                    $this->setWorld((int) $this->request->get('world'));
                }
                $world = $this->em->createQuery('SELECT
                            a.id as id,
                            a.external_id as externalId,
                            a.login as login,
                            a.name as name,
                            a.players as players,
                            a.players_inactive7 as playersInactive7,
                            a.alliances as alliances,
                            a.bases as bases,
                            a.bases_destroyed as basesDestroyed,
                            a.pois as pois,
                            a.pois as pois2,
                            a.pois as pois3,
                            a.pois as pois4,
                            a.pois as pois5,
                            a.pois as pois6,
                            a.pois as pois7,
                            a.pois as pois8,
                            a.service_id as serviceId
                        FROM HwsCncstatsBundle:World a
                        WHERE a.external_id = :external_id
                            AND a.do_show = 1')
                            ->setParameter('external_id', (int) $this->request->get('world'))
                            ->setMaxResults(1)
                            ->useResultCache(true, 21600, 'world')
                            ->getSingleResult();
            }

            $this->loadDatabase($world['id'], $world['serviceId']);
        } catch (NoResultException $e) {
            $response = new Response();
            $response->headers->setCookie(new Cookie('world', false, time() - 1000));
            $response->send();

            return false;
        }
        return $world;
    }

    public function setWorld($worldId) {
        try {
            $world = $this->em->createQuery('SELECT
                        a.id as id,
                        a.external_id as externalId,
                        a.service_id as serviceId
                    FROM HwsCncstatsBundle:World a
                    WHERE a.external_id = :external_id
                        AND a.do_show = 1')
                        ->setParameter('external_id', (int) $worldId)
                        ->setMaxResults(1)
                        ->useResultCache(true, 21600, 'world')
                        ->getSingleResult();
            $this->loadDatabase($world['id'], $world['serviceId']);
        } catch (NoResultException $e) {
            $response = new Response();
            $response->headers->setCookie(new Cookie('world', false, time() - 1000));
            $response->send();

            return false;
        }
        $response = new Response();
        $response->headers->setCookie(new Cookie('world', $world['external_id'], time() + 86400));
        $response->send();
        return $world;
    }

    private function loadDatabase($worldId, $serviceId) {
        $patternParams = $this->getConnectionParams('doctrine.dbal.worlds_pattern_service'.$serviceId.'_connection');

        $patternParams['dbname'] = $patternParams['dbname'].$worldId;

        $this->setConnectionParams('doctrine.dbal.worlds_connection', $patternParams);

        $this->service->get('doctrine')->resetEntityManager('worlds');
    }

    private function getConnectionParams($connectionName) {
        $connection = $this->service->get($connectionName);
        $connection->close();

        $refConn = new \ReflectionObject($connection);
        $refParams = $refConn->getProperty('_params');

        $refParams->setAccessible('public');
        $params = $refParams->getValue($connection);
        $refParams->setAccessible('private');

        return $params;
    }

    private function setConnectionParams($connectionName, $params) {
        $connection = $this->service->get($connectionName);
        $connection->close();

        $refConn = new \ReflectionObject($connection);
        $refParams = $refConn->getProperty('_params');

        $refParams->setAccessible('public');
        $refParams->setValue($connection, $params);
        $refParams->setAccessible('private');
    }
}
