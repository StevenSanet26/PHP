<?php
namespace App;
use LengthException;
class Dni{
    public function __construct(){
        throw new LengthException("Too long");
    }
}