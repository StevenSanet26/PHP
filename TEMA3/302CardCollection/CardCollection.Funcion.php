<?php
require "Card.php";
require "CardCollection.php";
$cardCollection = new CardCollection();
$suits=["cors", "diamants","trebol","piques"];
$symbols=["A","2","3","4","5","6","7","8","9","10","J","Q","K"];
$values=[14,2,3,4,5,6,7,8,9,10,11,12,13];

foreach ($suits as $suit){
    foreach ($symbols as $key=>$symbol){
           $cardCollection->addCard(new Card($suit,$symbol,$values[$key]));
    }
}
/*
$arrayCard[] = new Card("copa", "J", 11);
$arrayCard[] = new Card("espada", "Q", 12);
$arrayCard[] = new Card("basto", "K", 13);
$arrayCard[] = new Card("oro", "A", 14);
$arrayCard[] = new Card("copa", "Q", 12);
*/
//$cardCollection = new CardCollection();
//$cardCollection->add($arrayCard);
//$cardCollection->addCard(new Card("oro", "A", 14));

//var_dump($cardCollection->getCards());

$cardCollection->shuffle();

require "CardCollection.view.php";