<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RankingsController extends Controller {
    public function indexAction($global) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        return $this->render('HwsCncstatsBundle:Rankings:index'.($global == 1 ? '' : 'World').'.html.twig', array(
            'world'	=> $world
        ));
    }

    public function rankingAction($global, $type, $date, $period) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }
        
        if ($date == 'default') {
            $date = '-1 day';
        }
        
        $date = strtotime($date);

        if ($date > strtotime(date('Y-m-d'))) {
            return $this->forward('HwsCncstatsBundle:Rankings:index', array(
                'world'   => $world['externalId']
            ));
        }

        $date = date('Y-m-d', $date);
        
        $periodType = 0;
        if ($period == 'week') {
            $periodType = 1;
        } else if ($period == 'month') {
            $periodType = 2;
        } else {
            $period = 'day';
        }
        
        $rankingDates = '';
        
        $em = $this->get('query');
        
        try {
            $rankingType = $em->createQuery('default', 'SELECT a FROM HwsCncstatsBundle:RankingType a WHERE a.id = :type')->setParameter('type', $type)->getSingleResult();
            
            // get ranking for selected date
            try {
                if ($global != 1) {
                    $ranking =  $em->createQuery('world', '
                        SELECT a
                        FROM HwsCncstatsBundle:Ranking a
                        WHERE a.type_id = :type
                            AND a.period_type = :periodType
                            AND :date BETWEEN a.period_start AND a.period_end
                    ')->setParameter('type', $type)
                        ->setParameter('periodType', $periodType)
                        ->setParameter('date', $date)
                        ->getSingleResult();
                } else {
                    $ranking =  $em->createQuery('default', '
                        SELECT a
                        FROM HwsCncstatsBundle:Ranking a
                        WHERE a.type_id = :type
                            AND a.period_type = :periodType
                            AND :date BETWEEN a.period_start AND a.period_end
                    ')->setParameter('type', $type)
                        ->setParameter('periodType', $periodType)
                        ->setParameter('date', $date)
                        ->getSingleResult();
                }

                if ($ranking->getPeriodStart()->format('Y-m-d') !== $date) {
                    if ($global == 1) {
                        return $this->redirect($this->generateUrl('global_ranking_date', array(
                            'type'      => $type,
                            'date'      => $ranking->getPeriodStart()->format('Y-m-d'),
                            'period'    => $period
                        )), 301);
                    } else {
                        return $this->redirect($this->generateUrl('world_ranking_date', array(
                            'type'      => $type,
                            'date'      => $ranking->getPeriodStart()->format('Y-m-d'),
                            'period'    => $period,
                            'world'     => $world['externalId']
                        )), 301);
                    }
                }
                
                if ($ranking->getPeriodStart()->format('Y-m-d') === $ranking->getPeriodEnd()->format('Y-m-d')) {
                    $rankingDates = $ranking->getPeriodStart()->format('Y-m-d');
                } else {
                    $rankingDates = $ranking->getPeriodStart()->format('Y-m-d').' - '.$ranking->getPeriodEnd()->format('Y-m-d');
                }

                if ($global != 1) {
                    if ($rankingType->getType() === 'player') {
                        $rankingItems = $em->createQuery('world', '
                            SELECT
                                a.ranking,
                                a.value,
                                a.base_id,
                                a.base_name,
                                a.player_id,
                                p.name as player_name,
                                al.id as alliance_id,
                                al.name as alliance_name
                            FROM HwsCncstatsBundle:RankingRow a
                                LEFT JOIN HwsCncstatsBundle:Player p WITH (p.external_id = a.player_id)
                                LEFT JOIN HwsCncstatsBundle:Alliance al WITH (al.id = p.alliance_id)
                            WHERE a.ranking_id = :id
                            ORDER BY a.ranking ASC
                        ')->setParameter('id', $ranking->getId())
                            ->getResult();
                    } elseif ($rankingType->getType() === 'alliance') {
                        $rankingItems = $em->createQuery('world', '
                            SELECT
                                a.ranking,
                                a.value,
                                a.base_id,
                                a.base_name,
                                a.player_id,
                                a.player_name,
                                al.id as alliance_id,
                                al.name as alliance_name
                            FROM HwsCncstatsBundle:RankingRow a
                                LEFT JOIN HwsCncstatsBundle:Alliance al WITH (al.external_id = a.alliance_id)
                            WHERE a.ranking_id = :id
                            ORDER BY a.ranking ASC
                        ')->setParameter('id', $ranking->getId())
                            ->getResult();
                    } else {
                        return $this->forward('HwsCncstatsBundle:Rankings:index');
                    }
                } else {
                    $rankingItems = $em->createQuery('default', '
                        SELECT
                            a.ranking,
                            a.value,
                            a.base_id,
                            a.base_name,
                            a.player_id,
                            a.player_name,
                            a.alliance_id,
                            a.alliance_name,
                            wo.name as worldName,
                            wo.external_id as worldExternalId
                        FROM HwsCncstatsBundle:RankingRow a
                            LEFT JOIN HwsCncstatsBundle:World wo WITH (wo.id = a.world_id)
                        WHERE a.ranking_id = :id
                        ORDER BY a.ranking ASC
                    ')->setParameter('id', $ranking->getId())
                        ->getResult();
                }
            } catch(\Doctrine\Orm\NoResultException $e) {
                $rankingItems = array();
            }

            return $this->render('HwsCncstatsBundle:Rankings:list'.($global == 1 ? '' : 'World').'.html.twig', array(
                'world'         => $world,
                'rankingType'   => $rankingType,
                'selectedDate'  => $date,
                'rankingDates'  => $rankingDates,
                'items'         => $rankingItems,
                'period'        => $period,
                'currentUrl'    => 'http://'.$_SERVER['HTTP_HOST'].($global == 1 ? '' : '/world/'.$world['externalId']).'/ranking/'.$type.'/date/'.$date.'/'.$period
            ));
        } catch (\Doctrine\Orm\NoResultException $e) {
            return $this->forward('HwsCncstatsBundle:Rankings:index');
        }
    }
}
