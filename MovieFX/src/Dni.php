<?php

namespace App;

use DomainException;
use LengthException;
use function PHPUnit\Framework\throwException;

class Dni
{

    //private const VALIDATE_LENGTH = 9;

    public function __construct(string $dni)
    {

        //$this->checkDniHasValidationLength($dni);

/*
        if (preg_match("/\d$/", $dni)) {
            throw new DomainException("Ends with a number");
        }

        if (preg_match("/[IOUÑ\d]$/u", $dni)) {
            throw new DomainException("Ends with an invalid letter");
        }

        if (!preg_match("/\d{7}.$/", $dni)) {
            throw new DomainException("Has letters in the middle");
        }
*/
        if (!preg_match("/^[XYZ\d]\d{7,7}[^UIOÑ\d]$/u",$dni)) {
            throw new DomainException("Bad format");
        }
        throw new \InvalidArgumentException("Invalid dni");

    }
/*
    private function checkDniHasValidationLength(string $dni): void
    {
        if (strlen($dni) > self::VALIDATE_LENGTH) {
            throw new LengthException("Too long");
        }
        if (strlen($dni) < self::VALIDATE_LENGTH) {
            throw new LengthException("Too short");
        }
    }*/
}