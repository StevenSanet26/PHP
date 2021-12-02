<?php
namespace App;

class Config implements ConfigInterface
{
    function leerArchivo():string{
        $archivo =__DIR__."/config.ini";
        $contenido = parse_ini_file($archivo,true);
        echo var_export($contenido, true);
        return $contenido;
    }

    function getDataSourceName():string
    {
        // TODO: Implement getDataSourceName() method.
        return $this->leerArchivo();
    }
}