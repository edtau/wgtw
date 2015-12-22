<?php
/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__ . '/config.php';

// Create services and inject into the app. 

$di = new \Anax\DI\CDIMyFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);

//Add database
$di->setShared('db', function () {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database/config_mysql_bth.php');
    $db->connect();
    return $db;
});
 
