<?php
declare(strict_types=1);

class User{
    private int $id;
    private string $username;
    private string $password;
    private Plan $plan;

    public function __construct(int $id, string $username){
        $this->id=$id;
        $this->username=$username;
    }

    /**
     * @return int
     */
    public function getId(): int{
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId(int $id): void{
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getUsername(): string{
        return $this->username;
    }
    /**
     * @param string $username
     */
    public function setUsername(string $username): void{
        $this->username = $username;
    }
    /**
     * @return string
     */
    public function getPassword(): string{
        return $this->password;
    }
    /**
     * @param string $password
     */
    public function setPassword(string $password): void{
        $this->password = $password;
    }
    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }
    /**
     * @param Plan $plan
     */
    public function setPlan(Plan $plan): void{
        $this->plan = $plan;
    }
//ACTIVITAT CREANT TRANSACCIÓ
    public function rate(Movie $movie, int $value):void {
        //connexió a la base de dades
        $pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8","dbuser","1234");
        //Prequè generi excepcions a l'hora de reportar errors.
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //Es realitza la consulta
        $stmt=$pdo->prepare("SELECT count(id) as count 
                                    FROM rating
                                    WHERE movie_id = ?");
        //Torna les dades d'un array associatiu pel nom de camp de la taula
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //Se ejecuta la funcion
        $stmt->execute([$movie->getId()]);
        //Obtiene la siguiente fila de un conjunto de resultados
        $res=$stmt->fetch();
        $voters = $res["count"];

        $currentRating = $movie->getRating();
        $globalRating = $currentRating * $voters;
        $newRating = ($globalRating + $value)/($voters+1);

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO rating (user_id, movie_id, value) values (?,?,?)");
            $stmt->execute([$this->getId(), $movie->getId(), $value]);

            $stmt = $pdo->prepare("UPDATE movie set rating = ? WHERE id = ?");
            $stmt->execute([$newRating, $movie->getId()]);

            $movie->setRating($newRating);
            $pdo->commit();

        } catch (Exception $exception) {
            $pdo->rollBack();
            throw new Exception("Error en actualitzar la valoració");
        }
    }
}