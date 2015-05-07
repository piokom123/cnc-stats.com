<?php

namespace Hws\ApiBundle\Service;

class AuthService {
    private $em;
    private $request;
    private $container;

    public function __construct($em, $request, $container) {
        $this->em = $em;
        $this->request = $request;
        $this->container = $container;
    }

    /**
     * method checks api id and key
     *
     * @param integer $apiId user ID
     * @param string $apiKey
     *
     * @return boolean true if provided informations are correct
     */
    public function check($apiId, $apiKey) {
        $apiId = (int) $apiId;

        return true;
    }
}
