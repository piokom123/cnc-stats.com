<?php

namespace Hws\CncstatsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Hws\CncstatsBundle\DependencyInjection\Compiler;

class HwsCncstatsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new Compiler\OverrideQuerySubscriber());
    }
}
