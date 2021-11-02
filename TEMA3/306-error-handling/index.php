<?php

// Inicialitze les variables perquè existisquen en tots els possibles camins
// Sols emmagatzameré en elles valors vàlids.
// Acumularé els errors en un array per a mostrar-los al final.
// Use la sintaxi alternativa de les estructures de control per a la part de vistes.
// Cree funció clean per a netejar valors

const PHOTO_PATH = "photos";
const MAX_SIZE = 1048576;

require "helpers.php";
require "ValidationException.php";
require "FileUploadException.php";
require "RequiredValidationException.php";
require "TooLongValidationException.php";
require "TooShortValidationException.php";
require "InvalidPhoneValidationException.php";
require "InvalidEmailValidationException.php";
require "InvalidTypeFileException.php";
require "NoUploadedFileException.php";
require "TooBigFileException.php";

$contactTimes = [
    "range-1" => "Primera hora (08:00 a 10:00)",
    "range-2" => "Abans de dinar (12:00 a 13:00)",
    "range-3" => "Després de dinar (14:00 a 16:00)",
    "range-4" => "Per la nit (20:00 a 22:00)"
];


$firstname = "";
$lastname = "";
$phone = "";
$email = "";
$genre = "";
$hobbies = [];
$contactTime = [];
$photo = "";
$errors = [];

$validTypes = ["image/jpeg", "image/jpg"];

// per a la vista necessitem saber si s'ha processat el formulari
$isPost = false;

if (isPost()) {

    $isPost = true;

    try {
        if (validate_string($_POST["firstname"], 3, 25))
            $firstname = clean($_POST["firstname"]);
    } catch (ValidationException $e) {
        $errors[] = "Problema en el nom: " . $e->getMessage();
    }

    try {
        if (validate_string($_POST["lastname"], 3, 50))
            $lastname = clean($_POST["lastname"]);
    } catch (RequiredValidationException $e) {
        $errors[] = "El cognom no pot estar buit";
    } catch (TooLongValidationException $e) {
        $errors[] = "El cognom és massa llarg";
    } catch (TooShortValidationException $e) {
        $errors[] = "El cognom és massa curt";
    }


    try {
        if (validate_phone($_POST["phone"]))
            $phone = $_POST["phone"];
    } catch (InvalidPhoneValidationException $e) {
        $errors[] = "Tlfn no valido, deben ser exactamente 9 digitos";
    }


    try {
        if (validate_email($_POST["email"]))
            $email = $_POST["email"];
    } catch (InvalidEmailValidationException $e) {
        $errors[] = "Correu electrònic no indicat o erroni";
    }


    if (empty($_POST["genre"]))
        $errors[] = "Has de triar un gènere";
    else
        $genre = $_POST["genre"];

    if (empty($_POST["hobbies"] ?? []))
        $errors[] = "Has de triar almenys un hobbie";
    else
        $hobbies = $_POST["hobbies"];

    try {
        if (!empty($_POST["contact-time"]) && validate_elements_in_array_keys($_POST["contact-time"], $contactTimes))
            $contactTime = $_POST["contact-time"];
    } catch (InvalidKeyValidationException $e) {
        $errors[] = "Has de triar almenys un hora";
    }



    try {
        if (!empty($_FILES['photo']) && ($_FILES['photo']['error'] == UPLOAD_ERR_OK)) {
            if (!file_exists(PHOTO_PATH))
                mkdir(PHOTO_PATH, 0777, true);

            $tempFilename = $_FILES["photo"]["tmp_name"];
            $currentFilename = $_FILES["photo"]["name"];

            $mimeType = getFileExtension($tempFilename);

            $extension = explode("/", getFileExtension($tempFilename))[1];
            $newFilename = PHOTO_PATH . "/" . md5(rand()) . "." . $extension;
            $fileSize = $_FILES["photo"]["size"];

            if (!in_array($mimeType, $validTypes))
                throw new InvalidTypeFileException("La foto no és jpg");

            if ($extension != 'jpeg')
                throw new InvalidTypeFileException("La foto no és jpg");

            if ($fileSize > MAX_SIZE)
                throw new TooBigFileException("La foto té $fileSize bytes");

            if (!move_uploaded_file($tempFilename, $newFilename))
                throw new FileUploadException("No s'ha pogut moure la foto");

        } else
            throw new NoUploadedFileException("Cal pujar una photo");
    } catch (FileUploadException $e) {
        $errors[] = $e->getMessage();
    }
}

require "index.view.php";
