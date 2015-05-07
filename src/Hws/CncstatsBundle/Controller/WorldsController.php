<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WorldsController extends Controller {
    public function indexAction() {
        $em = $this->get('query');

        return $this->render('HwsCncstatsBundle:Worlds:index.html.twig', array(
            'items'	=> $em->createQuery('default', 'SELECT
                        a.id as id,
                        a.external_id as externalId,
                        a.name as name,
                        a.players as players,
                        a.players_inactive7 as playersInactive7,
                        a.alliances as alliances,
                        a.bases as bases,
                        a.bases_destroyed as basesDestroyed,
                        a.pois as pois
                    FROM HwsCncstatsBundle:World a
                    WHERE a.do_show = 1
                    ORDER BY a.external_id ASC', 'worlds')->getResult(),
            'world'	=> $this->get('world_service')->getWorld()
        ));
    }

    public function detailsAction() {
        $em = $this->get('query');

        return $this->render('HwsCncstatsBundle:Worlds:details.html.twig', array(
            'items'	=> $em->createQuery('default', 'SELECT
                    a.id as id,
                    a.external_id as externalId,
                    a.name as name,
                    a.players as players,
                    a.players_inactive7 as playersInactive7,
                    a.alliances as alliances,
                    a.bases as bases,
                    a.bases_destroyed as basesDestroyed,
                    a.pois as pois,
                    a.last_update_alliances as lastUpdateAlliances,
                    a.last_update_players as lastUpdatePlayers,
                    a.last_update_daily as lastUpdateDaily,
                    a.last_update_backups as lastUpdateBackups
                FROM HwsCncstatsBundle:World a
                WHERE a.do_show = 1
                ORDER BY a.external_id ASC', 'worlds')->getResult(),
            'world'	=> $this->get('world_service')->getWorld()
        ));
    }
}
