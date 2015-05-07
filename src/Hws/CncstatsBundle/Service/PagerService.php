<?php

namespace Hws\CncstatsBundle\Service;

class PagerService {
    public function getPagerData($currentPage, $itemsCount, $pageSize, $baseUrl) {
        $data = array(
            'currentPage'       => $currentPage,
            'enableFirst'       => false,
            'enablePrevious'    => false,
            'enableLast'        => false,
            'enableNext'        => false,
            'beforeCurrent'     => array(),
            'afterCurrent'      => array()
        );

        $lastPage = ceil($itemsCount / $pageSize);
        
        if ($currentPage > 1) {
            $data['enableFirst'] = true;
            $data['enablePrevious'] = true;
            
            $data['urlFirst'] = str_replace('{page}', 1, $baseUrl);
            $data['urlPrevious'] = str_replace('{page}', $currentPage - 1, $baseUrl);
 
            for ($i = ($currentPage - 1); $i > ($currentPage - 5); $i--) {
                if ($i <= 0) {
                    break;
                }

                $data['beforeCurrent'][$i] = str_replace('{page}', $i, $baseUrl);
            }

            $data['beforeCurrent'] = array_reverse($data['beforeCurrent'], true);
        }

        if ($currentPage < $lastPage) {
            $data['enableLast'] = true;
            $data['enableNext'] = true;
            
            $data['urlLast'] = str_replace('{page}', $lastPage, $baseUrl);
            $data['urlNext'] = str_replace('{page}', $currentPage + 1, $baseUrl);

            for ($i = ($currentPage + 1); $i < ($currentPage + 5); $i++) {
                if ($i > $lastPage) {
                    break;
                }

                $data['afterCurrent'][$i] = str_replace('{page}', $i, $baseUrl);
            }
        }
        
        return $data;
    }
}