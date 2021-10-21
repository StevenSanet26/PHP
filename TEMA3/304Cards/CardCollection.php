<?php

class CardCollection
{
    private array $Cards;
    private array $aleatoria1;


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

    public function writer(){
        foreach ($this->Cards as $card) {
            echo "<p>".$card -> getSuit()."-".$card -> getSymbol()."</p>";
        }

    }
    public function writerImg(){
        foreach ($this->Cards as $card) {

            echo "<img src=\"ImgCards/".$card -> getSymbol()."_of_".$card -> getSuit().".svg\"/>";
        }

    }


    public function deal():array{
$this->aleatoria1=[];

       // echo "<img src=\"ImgCards/". $this->Cards[$cartaAleatoria] -> getSymbol()."_of_". $this->Cards[$cartaAleatoria] -> getSuit().".svg\"/>";
        for ($i=0;$i<5;$i++) {
            $cartaAleatoria=array_rand($this->Cards);
            $this->aleatoria1[]=$this->Cards[$cartaAleatoria];

            //array_push($this->aleatoria1, $this->Cards[$cartaAleatoria]);
        }

        return $this->aleatoria1;

    }


    public function play(){
        $card1=$this->deal();
        $card2=$this->deal();
        var_dump($card1);
        var_dump($card2);


        echo $card2[1]->getSymbol();




    }



}
