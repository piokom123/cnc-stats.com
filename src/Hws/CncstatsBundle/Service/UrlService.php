<?php

namespace Hws\CncstatsBundle\Service;

class UrlService {
    private $request;
    private $router;
    
    public function __construct($request, $router) {
        $this->request = $request;
        $this->router = $router;
    }

    public function getBaseUrl($addDate = false, $addPage = false) {
        $routeName = $this->request->attributes->get('_route');
        $params = $this->request->attributes->get('_route_params');

        if ($routeName == null) {
            $guessedRoute = $this->router->match($_SERVER['REQUEST_URI']);

            $routeName = $guessedRoute['_route'];
            
            unset($guessedRoute['_route'], $guessedRoute['_controller']);
            
            $params = $guessedRoute;
        }

        if ($addDate) {
            if (array_key_exists('dateFrom', $params)) {
                $params['dateFrom'] = '{date}';
            } else {
                $params['date'] = '{date}';
            }
        }
        
        if ($addPage) {
            $params['page'] = '{page}';
        }

        if (array_key_exists('date', $params) && empty($params['date'])) {
            $params['date'] = date('Y-m-d');
        }

        if (array_key_exists('dateFrom', $params) && empty($params['dateFrom'])) {
            $params['dateFrom'] = date('Y-m-d');
        }

        $paramsKeys = array_keys($params);

        $newRouteName = substr($routeName, 0, stripos($routeName, '_')).'_'.implode('_', $paramsKeys);

        $newUrl = $this->router->generate($newRouteName, $params, true);
        $newUrl = urldecode($newUrl);

        return $newUrl;
    }
}
