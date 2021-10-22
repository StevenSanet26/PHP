<?php

class CardCollection
{
    private array $cards;

    function add(array $array)
    {
        //$this->cards = $array;
        foreach($array as $card) {
            $this->addCard($card);
        }
    }
    
    function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    function shuffle() {
        shuffle($this->cards);
    }

    function getCards(): array {
        return $this->cards;
    }

    function deal (int $amount = 1): array {
        $cards=[];
        for ($i=0; $i< $amount; $i++)
            $cards[]=array_shift($this->cards);

        return $cards;
    }

    function play(): Card {
        return array_shift($this->cards);
    }

}

