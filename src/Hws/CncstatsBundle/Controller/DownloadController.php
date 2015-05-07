<?php

namespace Hws\CncstatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DownloadController extends Controller {
    public function indexAction() {
        return $this->forward('HwsCncstatsBundle:Default:index');
    }

    public function poisAction() {
        $world = $this->get('world_service')->getWorld();
        if ($world == false) {
            return $this->forward('HwsCncstatsBundle:Default:index');
        }

        if (isset($_SERVER['HTTP_REFERER']) && stripos($_SERVER['HTTP_REFERER'], 'download') !== false) {
            $fileName = 'pois_world'.$world['externalId'].'.csv';
            $path = $this->get('kernel')->getRootDir(). "/../web/csv/pois/" . $fileName;
            $content = file_get_contents($path);

            $response = new Response();

            $response->headers->set('Content-Type', 'text/csv');
            $response->headers->set('Content-Disposition', 'attachment;filename="'.$fileName);

            $response->setContent($content);
            return $response;
        } else {
            return $this->render('HwsCncstatsBundle:Download:csv_pois.html.twig', array(
                'world'	=> $world
            ));
        }
    }
}
