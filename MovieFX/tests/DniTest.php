<?php
declare(strict_types=1);

namespace Tests\Dojo;

use App\Dni;
use DomainException;
use LengthException;
use PHPUnit\Framework\TestCase;

class DniTest extends TestCase
{
    public function testShouldFailWhenDniLongerThanMaxLength()
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('0123456789');
    }

    public function testShouldFailWhenDniShorterThanMinLength()
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('012345');
    }

    public function testShouldFailWhenDniEndsWithANumber(): void
    {
        $this->expectException(DomainException::class);
        //$this->expectExceptionMessage("Ends with a number");
        $dni = new Dni("012345678");
    }

    public function testShouldFailWhenDniEndsWithAnInvalidLetter(): void
    {
        $this->expectException(DomainException::class);
        //$this->expectExceptionMessage("Ends with an invalid letter");
        $dni = new Dni("01234567I");
    }

    public function testShouldFailWhenDniHasLettersInTheMiddle(): void
    {
        $this->expectException(DomainException::class);
        //$this->expectExceptionMessage("Has letters in the middle");
        $dni = new Dni("01234AB7R");
    }

    public function testShouldFailWhenDniStartsWithALetterOtherThanXYZ(): void
    {
        $this->expectException(DomainException::class);
        //$this->expectExceptionMessage("Starts with an invalid letter");
        $dni = new Dni("A1234567R");
    }

    public function testShouldFailWhenInvalidDni(): void
    {

        $this->expectException(\InvalidArgumentException::class);
        $dni = new Dni("00000000S");
    }
}