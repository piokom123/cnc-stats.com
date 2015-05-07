<?php

namespace Hws\ApiBundle\Listener;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

class ApiExceptionListener {
    private $container;
    public function __construct($container) {
        $this->container = $container;
    }

    public function onKernelException(GetResponseForExceptionEvent $event) {
        $exception	= $event->getException();

        $this->container->get('logger')->err($exception->getMessage());

        if(stripos($event->getRequest()->getPathInfo(), '/api') === 0) {
            $templating = $this->container->get('templating');

            $response = new Response($templating->render('HwsApiBundle:Exception:error.json.twig', array(
            'json' => json_encode(array('error' => 'Incorrect request'))
            )));
            $response->headers->set('Content-Type', 'application/json');

            $event->setResponse($response);
        }
    }
}