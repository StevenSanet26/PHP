<?php declare(strict_types=1); ?>
<?php
session_start();

require "helpers.php";
require 'src/Exceptions/FileUploadException.php';
require_once 'src/Exceptions/NoUploadedFileException.php';
require_once 'src/Exceptions/InvalidEmailValidationException.php';

const MAX_SIZE = 1024 * 1000;
const SCREENSHOT_PATH = "uploads";

$data["title"] = "";
$data["message"] = "";
$data["email"] = "";

$validTypes = ["image/jpeg", "image/jpg"];

$errors = [];

if (!isPost()) {
    die("Aquesta pàgina sols usa el mètode POST");
}

try {
    if (!empty($_FILES['screenshot']) && ($_FILES['screenshot']['error'] == UPLOAD_ERR_OK)) {
        if (!file_exists(SCREENSHOT_PATH))
            mkdir(SCREENSHOT_PATH, 0777, true);

        $tempFilename = $_FILES["screenshot"]["tmp_name"];
        $currentFilename = $_FILES["screenshot"]["name"];

        $mimeType = getFileExtension($tempFilename);

        $extension = explode("/", getFileExtension($tempFilename))[1];
        $newFilename = md5((string)rand()) . "." . $extension;
        $newFullFilename = SCREENSHOT_PATH . "/" . $newFilename;
        $fileSize = $_FILES["screenshot"]["size"];


        throw new InvalidTypeFileException("La foto no és d'un tipus permés");

        if (!move_uploaded_file($tempFilename, $newFullFilename))
            throw new FileUploadException("No s'ha pogut moure la foto");

        $data["screenshot"] = $newFilename;

    } else
        throw new NoUploadedFileException("Cal pujar una imatge");
} catch (FileUploadException $e) {
    $errors[] = $e->getMessage();
}

if (empty($errors)) {


}



