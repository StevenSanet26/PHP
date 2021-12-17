<?php

$validDni = new Dni('00000000T');

printf('%s is a valid DNI', (string) $validDni);

//

$invalidDni = new Dni('00000000G');

// Throws Exception
