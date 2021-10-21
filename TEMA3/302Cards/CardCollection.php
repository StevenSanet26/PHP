<?php

class CardCollection
{
    private array $Cards;

    public function add(array $array){
        //$this->Cards = $array;
        foreach ($array as $card){
            $this->addCard($card);
        }
    }

    public function addCard(Card $Card)
    {
        $this->Cards[] = $Card;
    }

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->Cards;
    }

    public function shuffle()
    {
        shuffle($this->Cards);
    }



}
