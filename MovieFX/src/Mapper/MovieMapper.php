<?php

namespace App\Mapper;

class MovieMapper
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Registry::getPDO("PDO");
    }

    public function find(int $id): ?Movie
    {
    }

    public function findAll(): array {
    }

    public function insert(Movie $obj)
    {
    }

    public function update(Movie $object)
    {
    }
}

