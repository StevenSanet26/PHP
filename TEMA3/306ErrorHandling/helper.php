<?php

function clear(string $value): string {
    $value = trim($value);
    return htmlspecialchars($value);
}

function isPost(){
    return $_SERVER["REQUEST_METHOD"] === "POST";

}

function validate_string(string $string, int $minLength = 1, int $maxLength = 50000){
    if (empty($string)) {
        throw new RequiredValidationException("Required firstname");
    }
    if ($string<$minLength){
        throw new TooShortValidationException("Firstname is too short");
    }
    if ($string>$maxLength){
        throw new TooLongValidationException("Firstname is too long");
    }
}




function validate_phone():bool{
    if(empty($_POST["phone"])){
        return true;
    }
    return false;
}

function validate_email():bool{
    if(empty($_POST["email"])){
        return true;
    }
    return false;
}


function is_empty($value):bool{
    return empty($value);
}

function is_selected(string $value,array $array):bool{
    if (in_array($value,$array)){
        return true;
    }
    return false;
}

/*
function validate_genere():bool{
    if(empty($_POST["genere"])){

        return true;
    }
    return false;
}



function validate_hobbies(){
    if(empty($_POST["hobbies"])){

        return true;
    }
    return false;
}


function validate_time(){
    if(empty($_POST["hobbies"])){

        return true;
    }
    return false;
}*/

