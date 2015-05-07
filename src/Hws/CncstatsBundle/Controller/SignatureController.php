<?php

namespace Hws\CncstatsBundle\Controller;

use Hws\CncstatsBundle\Entity\Signature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SignatureController extends Controller {
    public function indexAction() {
        return $this->render('HwsCncstatsBundle:Signature:index.html.twig', array(
            'world'	=> $this->get('world_service')->getWorld()
        ));
    }

    public function uploadAction() {
        $defaultEm  = $this->get('doctrine.orm.entity_manager');
        $request    = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $signatureType = (int) $request->request->get('signatureUploadType');

            if (!in_array($signatureType, array(1,2))) {
                $result = 'Incorrect signature type!';
            } else {
                $file = $request->files->get('signatureFile');

                if (stripos($file->getMimeType(), 'image') !== 0) {
                    $result = 'Only images are allowed!';
                } elseif ($file->getSize() > 1024 * 150) {
                    $result = 'Maximum file size is 150kB, your file got '. round($file->getSize() / 1024).'kB';
                } else {
                    $signature = new Signature;
                    $signature->setDate(new \DateTime('now'));
                    $signature->setLastUsed(new \DateTime('now'));
                    $signature->setType($signatureType);
                    $signature->setParams('');
                    $signature->setCode(md5(time().$file->getSize()));

                    $defaultEm->persist($signature);
                    $defaultEm->flush();

                    $file->move(
                        dirname(__FILE__).'/../../../../files/signatures/',
                        $signature->getId()
                    );
                    $result = array(
                        'code'	    => 'ok',
                        'message'   => $signature->getCode()
                    );
                }
            }
        } else {
            $result = 'Incorrect request!';
        }

        if (!is_array($result)) {
            $result = array(
            'code'	    => 'error',
            'message'   => $result
            );
        }

        return $this->render('HwsCncstatsBundle:Default:blank.json.twig', array(
            'json'	=> json_encode($result)
        ));
    }
}
