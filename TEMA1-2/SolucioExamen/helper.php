<?php
function clean(string $value): string {
    $value=trim($value);
    return htmlspecialchars($value);
}

function isPost(): bool {
    return $_SERVER["REQUEST_METHOD"]==="POST";
}

function validate_string(string $string, int $minLength = 1, int $maxLength = 50000): bool{
    if (strlen($string)<$minLength||strlen($string)>$maxLength){
        return false;
    }
    return true;
}

function validate_date(string $date): bool {
    if (DateTime::createFromFormat("Y-m-d", $date)===false)
        return false;
    return true;
}
function is_empty($value):bool {
    return empty($value);
}