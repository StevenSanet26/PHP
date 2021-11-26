<?php

/**
 * ACTIVITAT 602
 * 1. Comprovar que s'ha pujat la foto
 * 2. Obtenir el fitxer
 * 3. Comprovar el tipus
 * 4. Comprovar grandària
 * 5. Crear el nom aleatori
 * 6. Crear el directori
 * 7. Moure el fitxer
 * 8. Obtenim el mom definitiu
 */

require_once "Exceptions/FileUploadException.php";
require "Exceptions/InvalidTypeFileException.php";
require_once "Exceptions/TooBigFileException.php";
class UploadedFileHandler {
    private array $uploadedFile;

    public function __construct(string  $inputName, array $acceptedTypes, int $maxSize) {

        if($_FILES[$inputName]["errors"=UPLOAD_ERR_NO_FILE]){
            throw new FileUploadException("No s'ha pujat cap fitxer o ha segut un error");
        }
        
        if (empty($_FILES[$inputName]) || ($_FILES[$inputName]['error'] != UPLOAD_ERR_OK)) {
            throw  new Exception("No s'ha pujat cap fitxer o ha segut un error");
        }

        if (!in_array($_FILES[$inputName]["type"], $acceptedTypes)) {
            throw new InvalidTypeFileException("EL fitxer no és del tipus requerit");
        }

        if ($_FILES[$inputName]["size"] > $maxSize){
            throw new TooBigFileException("El fitxer supera el límit de la grandària(".$maxSize);
        }

        $this->uploadedFile=$_FILES[$inputName];
    }

    public function handle(string $directory): string{

            $tempFilename = $this->uploadedFile["tmp_name"];

            $newFilename = md5((string)rand());

            //GENEREM EL NOM DEFINITIU
            $extension = explode("/",$this->uploadedFile["type"])[1];
            $newFilename = md5((string)rand()).".".$extension;

            //RUTA DE LA CARPETA ON ES GUARDA
            $newFullFilename = $directory . "/" . $newFilename;

            if (!move_uploaded_file($tempFilename, $newFullFilename)) {
                throw new FileUploadException("No s'ha pogut moure el fitxer");
            }
            return $newFilename;
    }
}