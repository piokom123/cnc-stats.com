<?php

namespace Hws\CncstatsBundle\Service;

class GameService {
    private $_session;

    public function __construct() {
        $this->_session = new \stdClass();

        return $this;
    }

    public function login($user, $password = null, $lang = null) {
        $this->cookie = dirname(__FILE__).'/cookies/' . md5($user) . '.txt';

        $_login_fields = array(
            'spring-security-redirect' => '',
            'id' => '',
            'timezone' => '1',
            'j_username' => $user,
            'j_password' => $password,
            '_web_remember_me' => ''
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, 'https://www.tiberiumalliances.com/j_security_check');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_login_fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec( $ch );

        $urlL = 'https://www.tiberiumalliances.com/en/game/launch';
        curl_setopt($ch,CURLOPT_URL,$urlL);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.tiberiumalliances.com/en/login/auth');
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if (preg_match('/sessionId\" value=\"([^"]+)"/', $result, $match)) {
            $this->_session->id = $match[1];
        } else {
            // didn't found sessionId
        }

        if (preg_match('/action=\"([^"]+)\/index\.aspx"/', $result, $match)) {
            // ok...we can make it better ;)
            $_last_serverId = substr(parse_url($match[1], PHP_URL_PATH), 1);

            $this->_session->server = $this->getServer($_last_serverId);
        }
    }

    public function getServer($id) {
        $_account_data = $this->getData('https://gamecdnorigin.alliances.commandandconquer.com/Farm/Service.svc/ajaxEndpoint/', 'GetOriginAccountInfo', array('session'=>$this->_session->id));

        foreach ($_account_data->Servers as &$server) {
            if ($server->Id == $id) {
                return $server;
            }
        }

        return false;
    }


    public function openGameSession() {
        $_post_data = array (
          'session' => $this->_session->id,
          'reset' => true,
          'refId' => $this->getTimestamp(),
          'version' => -1,
          'platformId' =>1
        );

        $url = $this->_session->server->Url.'/Presentation/Service.svc/ajaxEndpoint/';
        $result = $this->getData($url, 'OpenSession', $_post_data);
        $this->_session->key = $result->i;
    }

    public function getData($url, $endpoint, $data) {
        sleep(1);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $endpoint);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8", "Cache-Control: no-cache", "Pragma: no-cache", "X-Qooxdoo-Response-Type: application/json"));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, str_replace('\\\\', '\\', json_encode($data)));
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        $result = curl_exec($ch);
        curl_close($ch);

        if (empty($result)) {
          $this->error = 'errrrrrrrrrrrrroooorrrrr';

          return false;
        }

        return json_decode($result);
    }

    public function get( $endpoint, $data=array()) {
        $data = array_merge(array('session' => $this->_session->key), $data);

        $url = $this->_session->server->Url . '/Presentation/Service.svc/ajaxEndpoint/';

        return $this->getData($url, $endpoint, $data);
    }

    private function getTimestamp() {
        $seconds = microtime(true); // false = int, true = float

        return round( ($seconds * 1000) );
    }
}