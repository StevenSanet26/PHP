<?php
class Employee{
    const MAX_SALARY=3333;
    private string $nom;
    private string $cognom;
    private int $sou;
    private array $arrayTelefon;
    /**
     * @return mixed
     */
    public function getNom():string{
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getCognom():string{
        return $this->cognom;
    }

    /**
     * @return mixed
     */
    public function getSou(): int{
        return $this->sou;
    }

    /**
     * @param mixed $cognom
     */
    public function setCognom($cognom): void{
        $this->cognom = $cognom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void{
        $this->nom = $nom;
    }

    /**
     * @param mixed $sou
     */
    public function setSou($sou): void{
        $this->sou = $sou;
    }

    function getFullname(): string{

        return $this->getNom()." ".$this->getCognom();
    }

    function mustPayTaxes():bool{
        if($this->sou>=self::MAX_SALARY){
            return true;
        }
        return false;
    }

    public function addPhone(string $phone): void{
        $this->arrayTelefon[]=$phone;
    }

    public function listPhones(): string{
        $numeros=implode(",",$this->arrayTelefon);
        return $numeros;
    }

    public function emptyPhones(): void{
        for($i=0;$i<count($this->arrayTelefon);$i++){
            unset($this->arrayTelefon[$i]);
        }
        //$this->arrayTelefon=[];
    }

    public function __construct(string $nom, string $cognom, int $sou=1000){
        $this->nom=$nom;
        $this->cognom=$cognom;

        if ($sou==null){
            $this->sou=1000;
        }else{
            /*
            if ($this->mustPayTaxes()){
                echo "Hi ha que pagar impostos";
            }
*/
            $this->sou=$sou;
            echo "no hi ha que pagar impostos";
        }
    }

    /**
     * @return array
     */
    public function getArrayTelefon(): array
    {
        return $this->arrayTelefon;
    }
    public static function toHtml (Employee $emp) :string{
        return $emp->getFullname()." ".$emp->getSou()." ". $emp->listPhones();
    }
}