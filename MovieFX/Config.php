<?php
class Config
{
    function leerArchivo(){
        $archivo =__DIR__."/config.ini";
        $contenido = parse_ini_file($archivo,true);
        echo var_export($contenido, true);
        return $contenido;
    }
}