<?php

namespace Hws\CncstatsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideQuerySubscriber implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('knp_paginator.subscriber.paginate');
        $definition->setClass('Hws\CncstatsBundle\Service\Pagination\PaginationSubscriber');
    }
}