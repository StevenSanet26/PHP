<?php
declare(strict_types=1);

require "helpers.php";

$idTemp= filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);

if (!empty($idTemp)){
    $id=$idTemp;
}else{
    throw new Exception("Invalid ID");

}
