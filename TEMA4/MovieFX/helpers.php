<?php
require_once "Exceptions/ValidationException.php";
require_once "Exceptions/RequiredValidationException.php";
require_once "Exceptions/TooShortValidationException.php";
require_once "Exceptions/TooLongValidationException.php";
function clean(string $value): string{
    $value = trim($value);
    return htmlspecialchars($value);
}

function isPost(): bool{
    return $_SERVER["REQUEST_METHOD"] === "POST";
}

function validate_string(string $string, int $minLength = 1, int $maxLength = 50000): bool{
    if (empty($string))
        throw new RequiredValidationException("The string is required");
    if (strlen($string) < $minLength)
        throw new TooShortValidationException("The string is too short");
    if (strlen($string) > $maxLength)
        throw new TooLongValidationException("The string is too long");

    return true;
}

function validate_date(string $date): bool {

    if (DateTime::createFromFormat("Y-m-d", $date)===false)
        return false;

    $errors = DateTime::getLastErrors();

    //var_dump($errors);
    if (count($errors["warnings"])>0 || count($errors["errors"])>0)
        return false;

    return true;
}

function getFileExtension(string $filename): string
{
    $mime = "";
    try {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $filename);
        if ($mime === false)
            throw new Exception();
    } // return mime-type extension
    finally {
        finfo_close($finfo);
    }
    return $mime;
}
