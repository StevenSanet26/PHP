<?php

function clear(string $value): string {
    $value = trim($value);
    return htmlspecialchars($value);
}

function isPost(){
    return $_SERVER["REQUEST_METHOD"] === "POST";

}

/**
 * @throws TooShortValidationException
 * @throws RequiredValidationException
 * @throws TooLongValidationException
 */
function validate_firstname(string $string, int $minLength = 1, int $maxLength = 50000): bool{
    if (empty($string)) {
        throw new RequiredValidationException("Required firstname");
    }
    if (strlen($string)<$minLength){
        throw new TooShortValidationException("Firstname is too short");
    }
    if (strlen($string)>$maxLength){
        throw new TooLongValidationException("Firstname is too long");
    }
    return true;
}

function validate_lastname(string $string, int $minLength = 1, int $maxLength = 50000): bool{
    if (empty($string)) {
        throw new RequiredValidationException("Required lastname");
    }
    if (strlen($string)<$minLength){
        throw new TooShortValidationException("Lastname is too short");
    }
    if (strlen($string)>$maxLength){
        throw new TooLongValidationException("Lastname is too long");
    }
    return true;
}


/**
 * @throws InvalidPhoneValidationException
 * @throws RequiredValidationException
 */
function validate_phone(string $phone):bool{
    if(empty($phone)){
        throw new RequiredValidationException("Required phone");
    }if (!preg_match("/^\d{9}$/",$phone)) {
        throw new InvalidPhoneValidationException("Phone error");
    }
    return true;
}

function validate_email(string $email):bool{
    if(empty($email)){
        throw new RequiredValidationException("Required email");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidEmailValidationException("Email error");
    }
    return true;
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

