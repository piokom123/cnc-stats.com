<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SaadTazi\GChartBundle\DataTable;
use SaadTazi\GChartBundle\Chart\PieChart;

class ChartsController extends Controller {
    public function alliancePoisAction($externalId) {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        $em = $this->get('query');

        $poisTmp = $em->createQuery('default', 'SELECT a FROM HwsCncstatsBundle:PoiType a')->getResult();
        $pois = array();
        foreach($poisTmp as $tmp) {
            $pois[$tmp->getType()] = $tmp;
        }
        unset($poisTmp);

        try {
            $query = $em->createQuery('world', 'SELECT a FROM HwsCncstatsBundle:Alliance a WHERE a.external_id = :external_id')->setParameter('external_id', $externalId);
            $item = $query->getSingleResult();

            $chartPoi = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois(),
                            'f' => $item->getPois()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois'] - $item->getPois()),
                            'f' => ($world['pois'] - $item->getPois())
                        )
                    )
                )
            ));

            $chartPoi2 = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois2(),
                            'f' => $item->getPois2()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois2'] - $item->getPois2()),
                            'f' => ($world['pois2'] - $item->getPois2())
                        )
                    )
                )
            ));

            $chartPoi3 = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois3(),
                            'f' => $item->getPois3()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois3'] - $item->getPois3()),
                            'f' => ($world['pois3'] - $item->getPois3())
                        )
                    )
                )
            ));

            $chartPoi4 = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois4(),
                            'f' => $item->getPois4()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois4'] - $item->getPois4()),
                            'f' => ($world['pois4'] - $item->getPois4())
                        )
                    )
                )
            ));

            $chartPoi5 = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois5(),
                            'f' => $item->getPois5()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois5'] - $item->getPois5()),
                            'f' => ($world['pois5'] - $item->getPois5())
                        )
                    )
                )
            ));

            $chartPoi6 = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois6(),
                            'f' => $item->getPois6()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois6'] - $item->getPois6()),
                            'f' => ($world['pois6'] - $item->getPois6())
                        )
                    )
                )
            ));

            $chartPoi7 = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois7(),
                            'f' => $item->getPois7()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois7'] - $item->getPois7()),
                            'f' => ($world['pois7'] - $item->getPois7())
                        )
                    )
                )
            ));

            $chartPoi8 = new DataTable\DataTable(array(
                'cols' => array(
                    array(
                        'id'	=> 'id1',
                        'label' => 'label1',
                        'type'	=> 'string'
                    ),  array(
                        'id'	=> 'id2',
                        'label' => 'label2',
                        'type'	=> 'number'
                    )
                ),
                'rows' => array(
                    array(
                        array(
                            'v' => 'Alliance POIs'
                        ), array(
                            'v' => (int) $item->getPois8(),
                            'f' => $item->getPois8()
                        )
                    ), array(
                        array(
                            'v' => 'Others POIs'
                        ), array(
                            'v' => (int) ($world['pois8'] - $item->getPois8()),
                            'f' => ($world['pois8'] - $item->getPois8())
                        )
                    )
                )
            ));

            return $this->render('HwsCncstatsBundle:Charts:alliance_pois.html.twig', array(
                'item'	    => $item,
                'world'	    => $world,
                'pois'	    => $pois,
                'chartPoi'  => $chartPoi->toArray(),
                'chartPoi2'  => $chartPoi2->toArray(),
                'chartPoi3'  => $chartPoi3->toArray(),
                'chartPoi4'  => $chartPoi4->toArray(),
                'chartPoi5'  => $chartPoi5->toArray(),
                'chartPoi6'  => $chartPoi6->toArray(),
                'chartPoi7'  => $chartPoi7->toArray(),
                'chartPoi8'  => $chartPoi8->toArray()
            ));
        } catch (\Doctrine\Orm\NoResultException $e) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }
    }
}