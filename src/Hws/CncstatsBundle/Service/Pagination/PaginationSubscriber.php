<?php

namespace Hws\CncstatsBundle\Service\Pagination;

use Knp\Component\Pager\Event\Subscriber\Paginate\ArraySubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\Doctrine\ORM\QueryBuilderSubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\Doctrine\ODM\MongoDB\QueryBuilderSubscriber as ODMQueryBuilderSubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\Doctrine\ODM\MongoDB\QuerySubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\Doctrine\CollectionSubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\Doctrine\DBALQueryBuilderSubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\PropelQuerySubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\SolariumQuerySubscriber;
use Knp\Component\Pager\Event\Subscriber\Paginate\ElasticaQuerySubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knp\Component\Pager\Event\PaginationEvent;
use Knp\Component\Pager\Event\BeforeEvent;
use Knp\Component\Pager\Pagination\SlidingPagination;

class PaginationSubscriber implements EventSubscriberInterface
{
    public function pagination(PaginationEvent $event)
    {
        $event->setPagination(new SlidingPagination);
        $event->stopPropagation();
    }

    public function before(BeforeEvent $event)
    {
        $disp = $event->getEventDispatcher();
        // hook all standard subscribers
        $disp->addSubscriber(new ArraySubscriber);
        $disp->addSubscriber(new QueryBuilderSubscriber);
        $disp->addSubscriber(new BetterQuerySubscriber($this->cache));
        $disp->addSubscriber(new ODMQueryBuilderSubscriber);
        $disp->addSubscriber(new QuerySubscriber);
        $disp->addSubscriber(new CollectionSubscriber);
        $disp->addSubscriber(new DBALQueryBuilderSubscriber);
        $disp->addSubscriber(new PropelQuerySubscriber);
        $disp->addSubscriber(new SolariumQuerySubscriber());
        $disp->addSubscriber(new ElasticaQuerySubscriber());
    }

    public static function getSubscribedEvents()
    {
        return array(
            'knp_pager.before' => array('before', 0),
            'knp_pager.pagination' => array('pagination', 0)
        );
    }
}
