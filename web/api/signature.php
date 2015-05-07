<?php

openlog('cncstats', LOG_PID, LOG_USER);

require_once dirname(__FILE__).'/../../libraries/spyc/spyc.php';

try {
    if (!isset($_GET['sig'])) {
        die();
    }

    if(!file_exists(dirname(__FILE__).'/../../app/config/parameters.yml')) {
	syslog(LOG_ERR, 'Signature: config file not found!');
	die('');
    }

    $config = Spyc::YAMLLoad(dirname(__FILE__).'/../../app/config/parameters.yml');

    $pdo = new PDO('mysql:dbname='.$config['parameters']['database_name'].';host='.$config['parameters']['database_host'].'', $config['parameters']['database_user'], $config['parameters']['database_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET time_zone = 'Europe/Warsaw';");
    $pdo->exec("SET NAMES 'UTF8';");
    unset($db);

    $sig = preg_replace('[^A-Za-z0-9]', '', $_GET['sig']);

    $signature = $pdo->query("SELECT id, type, world_id FROM signatures WHERE `code` = '".$sig."' LIMIT 1")->fetch();
    if(!is_array($signature) || empty($signature)) {
	syslog(LOG_ERR, 'Signature: code = '.$sig.' not found!');
	die;
    }

    $filePath = dirname(__FILE__).'/../../files/signatures/'.$signature['id'];

    $fileInfo = new finfo(FILEINFO_MIME);
    $mimeType = $fileInfo->buffer(file_get_contents($filePath));

    header('Content-Type: ' + $mimeType);
    readfile($filePath);

    if (isset($_GET['preview'])) {
        die;
    }

    if ($signature['type'] != 1 && $signature['type'] != 2) {
        die;
    }

    $database = $config['parameters']['database_name_worlds'].$signature['world_id'];
} catch(PDOException $e) {
    if ($debug) {
        echo $e->getMessage();
    }

    syslog(LOG_ERR, 'Autocomplete: db error: '.$e->getMessage());
    echo '<br />Blad komunikacji z baza danych!';
}

closelog();