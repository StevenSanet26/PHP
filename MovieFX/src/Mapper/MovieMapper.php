<?php

namespace App\Mapper;


use App\Movie;
use App\Registry;
use PDO;

class MovieMapper
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Registry::get("PDO");
    }

    public function find(int $id): ?Movie
    {
        $stmt = $this->pdo->prepare("SELECT * FROM movie WHERE id=:id");
        $stmt->execute(["id" => $id]);
        $row = $stmt->fetch();
        $stmt->closeCursor();
        if (!is_array($row)) {
            return null;
        }
        if (!isset($row['id'])) {
            return null;
        }
        $object = Movie::fromArray($row);
        return $object;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM movie");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $moviesAr = $stmt->fetchAll();
        $movies = [];
        foreach ($moviesAr as $movie) {
            $movies[] = Movie::fromArray($movie);
        }
        return $movies;
    }

    public function insert(Movie $obj)
    {
        $data = $obj->toArray();
        unset($data["id"]);
        $stmt = $this->pdo->prepare("INSERT INTO movie(title, overview, release_date, rating, poster) 
        VALUES (:title, :overview, :release_date, :rating, :poster)");
        $stmt->execute($data);
        $obj->setId($this->pdo->lastInsertId());
    }

    public function update(Movie $object)
    {
        $values = $object->toArray($object);

        $updateStmt = $this->pdo->prepare(
            "UPDATE movie 
                            set title = :title, 
                                overview = :overview, 
                                release_date =:release_date, 
                                rating = :rating, 
                                poster=:poster
                                WHERE id = :id"
        );
    }
}
