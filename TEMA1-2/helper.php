<?php

function clear(string $value): string {
    $value = trim($value);
    return htmlspecialchars($value);
}

function validate_firstname(): bool{
    if(empty($_POST["firstname"])){
        return true;
    }
    return false;
}

function validate_lastname():bool{
    if(empty($_POST["lastname"])){
        return true;
    }
    return false;
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

