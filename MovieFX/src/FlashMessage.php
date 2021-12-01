<?php
namespace App;
# src/Core/Helpers/FlashMessage.php

/**
 * Class FlashMessage
 * Aquesta classe llig i escriu directament en una variable de sessió
 * que serà un array, la clau serà $sessionKey  de forma que evitem
 * possible col·lisions.
 */
class FlashMessage{

    const SESSION_KEY = "flash-message";

    /**
     * ACTIVITAT 601
     * obtenim el valor de l'array associat a la clau.
     * després de llegir-lo l'esborrem
     * si no existeix tornem el valor indicat per defecte.
     */

    public static function get(string $key, $defaultValue = ''){
        $value=$_SESSION[self::SESSION_KEY][$key] ?? $defaultValue;
        self::unset($key);
        return $value;
    }

    public static function set(string $key, $value):void{
        $_SESSION[self::SESSION_KEY][$key]=$value;
    }

    private static function unset(string $key){
        //unset() destruye las variables especificadas.
        unset($_SESSION[self::SESSION_KEY][$key]);
    }
}