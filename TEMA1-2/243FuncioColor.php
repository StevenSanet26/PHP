<?php

cambiarColor(255,0,255);

function cambiarColor(int $roig, int $verd, int $blau):string{
        $color="";
    if($roig>0 || $roig<=255){
         echo "#".dechex($roig);
    }

    if($verd>0 || $verd<=255){
        echo dechex($verd);

    }

    if($blau>0 || $blau<=255){
         echo dechex($blau);
    }
    return $color;
}
