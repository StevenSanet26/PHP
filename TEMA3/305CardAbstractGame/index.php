<?php

require "Card.php";
require "CardCollection.php";
require "CardCollectionWriter.php";
require "CardCollectionWriterUnicode.php";
require "CardCollectionWriterImage.php";
require "Deck.php";
require "Hand.php";

$writer = rand(3, 3);

switch ($writer){

    case 1: 
        $cardCollectionWriter = new CardCollectionWriter();
        break;
    case 2: 
        $cardCollectionWriter = new CardCollectionWriterUnicode();
        break;
    case 3: 
        $cardCollectionWriter = new CardCollectionWriterImage();
        break;
    default: 
        $cardCollectionWriter = new CardCollectionWriterUnicode();

}

$cardCollection=new CardCollection();
$Deck= new Deck();
$Hand = new Hand();

$suits = ["hearts", "diamonds", "spades", "clubs"];

$symbols = ["A", "2", "3", "4", "5", "6", "7", 
    "8", "9", "10", "J", "Q", "K"];

$values = [14, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];    

foreach ($suits as $suit) {
    foreach ($symbols as $key=>$symbol){        
            $Deck->addCard(new Card($suit, $symbol,$values[$key]));
    }
}

//var_dump(count($cardCollection->getCards()));
$Deck->shuffle();

$handPlayer1 = new Hand();
$handPlayer2 = new Hand();

$numberOfCards = 5;
$handPlayer1->add($Deck->deal($numberOfCards));
$handPlayer2->add($Deck->deal($numberOfCards));

$result = 0;
ob_start();
$cardCollectionWriter->write($Deck);
$cards = ob_get_clean();

$cardsPlayer1 = "";
$cardsPlayer2 = "";
$results = [];

do {
    ob_start();
    $cardCollectionWriter->write($handPlayer1);
    $cardsPlayer1 .= ob_get_clean();
    ob_start();
    $cardCollectionWriter->write($handPlayer2);
    $cardsPlayer2 .= ob_get_clean();


    while (count($handPlayer1->getCards()) > 0) {
        $card1 = $handPlayer1->play();
        $card2 = $handPlayer2->play();

        $results[] = $card1->getValue() <=> $card2->getValue();
    }
    $result = array_sum($results);

    if ($result==0) {
        $numberOfCards = 1;
        $handPlayer1->add($Deck->deal($numberOfCards));
        $handPlayer2->add($Deck->deal($numberOfCards));
    }

} while ($result==0);
// operador nau espacial
// echo 1 <=> 1; // 0
// echo 1 <=> 2; // -1
// echo 2 <=> 1; // 1

//si result és positu guanya player 1
// si eś negatiu guanya player 2
// si zero empat

require "index.view.php";
