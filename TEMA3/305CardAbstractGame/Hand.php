<?php

class Hand extends CardCollection{
    function play(): Card {
        return array_shift($this->cards);
    }


}

