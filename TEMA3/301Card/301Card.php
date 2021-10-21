<?php
require "card.php";

$carta1 = new Card("copa","J",11);
$carta2 = new Card("espada","Q",12);
$carta3 = new Card("basto","K",13);
$carta4 = new Card("oro","A",14);
$carta5 = new Card("copa","Q",12);

$arrayCartas=[$carta1,$carta2,$carta3,$carta4,$carta5];


//print_r($arrayCartas);

require "301Card.view.php";