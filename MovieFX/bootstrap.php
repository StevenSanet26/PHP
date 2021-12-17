<?php
require "vendor/autoload.php";

use App\Config;
use App\Registry;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

//$configIni = new Config(__DIR__."/config.ini");
$configXML = new Config(__DIR__."/config.xml");

Registry::setPDO($configXML);
//Registry::setPDO($configJson);

// create a log channel
$log = new Logger('movies');
$log->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
$log->pushHandler(new FirePHPHandler());
Registry::set(Registry::LOGGER, $log);



//require_once 'src/Registry.php';
/*
require "Config.php";

$Config = new Config();
$DSN = $Config->leerArchivo();



$pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8;","dbuser","1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

Registry::set("PDO",$pdo);

//create a log channel
$log = new Logger("movies");
$log->pushHandler(new StreamHandler("app.log", Logger::DEBUG));
$log->pushHandler(new FirePHPHandler());
Registry::set("LOGGER",$log);
/*
//add records to the log
$log->warning("Foo");
$log->error("Bar");
$log->info("Info");
*/