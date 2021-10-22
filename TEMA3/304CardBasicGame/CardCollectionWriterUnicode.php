<?php
class CardCollectionWriterUnicode {
    public function __construct() {
        $this->codes =[
                "spades"=>["&spades;", "black"],
                "diamonds"=>["&diams;","red"],
                "hearts"=>["&hearts;", "red"],
                "clubs"=>["&clubs;", "black"]
        ];
    }
    public function write(CardCollection $cardCollection) {
        foreach ($cardCollection->getCards() as $card) {
            echo sprintf("<div>%s <span style=\"color:%s\"> %s</span> </div>", $card->getSymbol(), 
                $this->codes[$card->getSuit()][1], $this->codes[$card->getSuit()][0]);
        }
    }
}
?>