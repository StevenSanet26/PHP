<?php
class CardCollectionWriterImage {
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
            echo sprintf("<div><img src=\"cards\%s_of_%s.svg\" alt=\"%s \" /></div>\n", $card->getSymbol(),
                $card->getSuit(), $this->codes[$card->getSuit()][0]);
        }
    }
}
?>