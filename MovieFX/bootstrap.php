<?php
require "vendor/autoload.php";
use App\Registry;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


require_once 'src/Registry.php';
/*
require "Config.php";

$Config = new Config();
$DSN = $Config->leerArchivo();

/*
$mysql = $DSN["DSN"]["mysql:host"];
$db = $DSN["DSN"]["dbname"];
$charset = $DSN["DSN"]["charset"];
$user = $DSN["DSN"]["user"];
$pwd = $DSN["DSN"]["password"];

$pdo = new PDO("mysql:host=".$mysql.";dbname=".$db.";charset=".$charset,$user, $pwd);
*/
$pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8;","dbuser","1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

Registry::set("PDO", $pdo);

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