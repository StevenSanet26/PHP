<?php
function clean(string $value): string {
    $value = trim($value);
    return htmlspecialchars($value);
}

function isPost(): bool {
    return $_SERVER["REQUEST_METHOD"]==="POST";
}

function validate_string(string $string, int $minLength = 1, int $maxLength = 50000): bool
{
    if (strlen($string) < $minLength || strlen($string)>$maxLength)
        return false;

    return true;
}

function validate_date(string $date): bool {
    //option 1: timestamp option    
    if (strtotime($date)===false)
        return false;
    
    // option 2: a more accurate version 
    $dateParts = explode("-", $date);

    if (count($dateParts)!=3) 
        return false;
    elseif (filter_var($dateParts[0], FILTER_VALIDATE_INT) //Paranoic mode 
        && filter_var($dateParts[1], FILTER_VALIDATE_INT) 
        && filter_var($dateParts[2], FILTER_VALIDATE_INT))
            return (checkdate((int) $dateParts[1], (int)$dateParts[2],(int)$dateParts[0]));
        else 
            return false;        

    //option 3: simpler option
    if (DateTime::createFromFormat("Y-m-d", $date)===false)
        return false;

    return true;
}

function is_empty($value):bool {
    return empty($value);
}

// compare if the current value in the selected array
function is_selected(string $value, array $array): bool {
    if (in_array($value, $array))
        return true;
    return false;
}

function show_post() {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}