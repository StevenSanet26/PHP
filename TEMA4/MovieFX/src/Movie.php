<?php
declare(strict_types=1);

class Movie{
    const POSTER_PATH="img";
    private int $id;
    private string $title;
    private string $overview;
    private string $releaseDate;
    private float $rating;
    private string $poster;

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getId(): int{
        return $this->id;
    }

    public function setTitle(string $title): void{
        $this->title = $title;
    }

    public function getTitle(): string{
        return $this->title;
    }

    public function setOverview(string $overview): void{
        $this->overview = $overview;
    }

    public function getOverview(): string{
        return $this->overview;
    }

    public function setReleaseDate(string $releaseDate): void{
        $this->releaseDate = $releaseDate;
    }

    public function getReleaseDate(): string{
        return $this->releaseDate;
    }

    public function setRating(float $rating): void{
        $this->rating = $rating;
    }

    public function getRating(): float{
        return $this->rating;
    }

    public function setPoster(string $poster): void{
        $this->poster = $poster;
    }

    public function getPoster(): string{
        return $this->poster;
    }
}