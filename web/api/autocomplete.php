<?php

openlog('cncstats', LOG_PID, LOG_USER);

$debug = false;

require_once dirname(__FILE__).'/../../libraries/spyc/spyc.php';

try {
    if(!file_exists(dirname(__FILE__).'/../../app/config/parameters.yml')) {
        syslog(LOG_ERR, 'Autocomplete: config file not found!');
        die('');
    }

    if(!isset($_GET['worldId'])) {
        syslog(LOG_ERR, 'Autocomplete: empty worldId!');
        die;
    }

    $config = Spyc::YAMLLoad(dirname(__FILE__).'/../../app/config/parameters.yml');

    $pdo = new PDO('mysql:dbname='.$config['parameters']['database_name'].';host='.$config['parameters']['database_host'].'', $config['parameters']['database_user'], $config['parameters']['database_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET time_zone = 'Europe/Warsaw';");
    $pdo->exec("SET NAMES 'UTF8';");

    $world = $pdo->query("SELECT id, service_id FROM worlds WHERE `external_id` = '".(int) $_GET['worldId']."' LIMIT 1")->fetch();
    if(!is_array($world) || empty($world)) {
        syslog(LOG_ERR, 'Autocomplete: world with externalId = '.(int) $_GET['worldId'].' not found!');
        die;
    }
    
    if (!isset($_GET['term'])) {
        $term = '';
    } else {
        $term = '.*'.preg_replace('[^A-Za-z0-9_\-\s]', '', $_GET['term']).'.*';
    }
    
    $mongoConn = new \MongoClient('mongodb://');
    
    $mongoDb = $mongoConn->{"cncstatscom_world".$world['id']};

    $results = null;
    if(@$_GET['type'] == 'alliances') {
        if (mb_strlen($term) == 0) {
            $results = $mongoDb->alliances->find(array(), array('_id' => false, 'exid' => true, 'n' => true))->limit(10);
        } else {
            $results = $mongoDb->alliances->find(array('n' => array('$regex' => $term, '$options' => 'i')), array('_id' => false, 'exid' => true, 'n' => true))->limit(10);
        }
    } elseif(@$_GET['type'] == 'players') {
        if (mb_strlen($term) == 0) {
            $results = $mongoDb->players->find(array(), array('_id' => false, 'exid' => true, 'n' => true))->limit(10);
        } else {
            $results = $mongoDb->players->find(array('n' => array('$regex' => $term, '$options' => 'i')), array('_id' => false, 'exid' => true, 'n' => true))->limit(10);
        }
    } elseif(@$_GET['type'] == 'bases') {
        // @TODO
    }
    
    if ($results != null) {
        $results = iterator_to_array($results);
        
        $readyResults = array();
        
        foreach ($results as $result) {
            $readyResults[] = array(
                'label' => $result['n'],
                'value' => $result['exid']
            );
        }

        echo json_encode($readyResults);
    }

} catch(PDOException $e) {
    if($debug) {
        echo $e->getMessage();
    }

    syslog(LOG_ERR, 'Autocomplete: db error: '.$e->getMessage());
    echo '<br />Blad komunikacji z baza danych!';
}

closelog();
