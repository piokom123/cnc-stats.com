<?php

namespace Hws\CncstatsBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CncstatsExceptionListener {
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function onKernelException(GetResponseForExceptionEvent $event) {
        $exception	= $event->getException();

        $this->container->get('logger')->err(get_class($exception).': '.$exception->getMessage().' On: '.$_SERVER['REQUEST_URI'].' From: '.@$_SERVER['HTTP_REFERER'].' IP: '.@$_SERVER['REMOTE_ADDR']);

        if ('dev' == $this->container->getParameter('kernel.environment')) {
            throw $exception;
        }

        $response = new RedirectResponse('/problem');

        return $event->setResponse($response);
    }
}