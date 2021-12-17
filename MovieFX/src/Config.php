<?php
namespace App;

class Config
{
    public static function getDsnByXML(string $nameFile = "config.xml")
    {
        $xml = simplexml_load_file($nameFile);
        return $xml->dsn;
    }
/*
    public static function getUploadsByXML(string $nameFile = "config.xml")
    {
        $xml = simplexml_load_file($nameFile);
        return $xml->rutaFotos;
    }
*/
    public static function leerFicheroXML(string $nameFile = "config.xml")
    {
        $configs = simplexml_load_file($nameFile);

        echo $configs->dsn;
       // echo $configs->rutaFotos;
    }
}
