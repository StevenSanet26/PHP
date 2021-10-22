<?php
class Deck extends CardCollection {

    public function shuffle() {
        shuffle($this->cards);
    }

    function deal (int $amount = 1): array {
        $cards=[];
        for ($i=0; $i< $amount; $i++)
            $cards[]=array_shift($this->cards);

        return $cards;
    }
    }