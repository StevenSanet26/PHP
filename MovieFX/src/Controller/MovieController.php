<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exceptions\FileUploadException;
use App\Exceptions\NoUploadedFileException;
use App\FlashMessage;
use App\Mapper\MovieMapper;
use App\Movie;
use App\Registry;
use App\Repository\MovieRepository;
use App\UploadedFileHandler;
use Exception;

class MovieController{

    const MAX_SIZE = 1024*1000;

    public function list(){
        $mapper = new MovieMapper();
        $movieRepository = new MovieRepository($mapper);
        $movies = $movieRepository->findAll();

        $router = Registry::get(Registry::ROUTER);

        require __DIR__ ."/../../views/index.view.php";
    }
    public function edit(int $id) {
        echo "editant la pel·lícula #{$id}";

        $mapper = new MovieMapper();
        $movieRepository = new MovieRepository($mapper);
        $movie = $movieRepository->find($id);

        $router = Registry::get(Registry::ROUTER);

        if (empty($movie))
            throw new Exception("La pel·lícula seleccionada no existeix");

        $data = $movie->toArray();

        $validTypes = ["image/jpeg", "image/jpg"];

        $errors = [];

        // per a la vista necessitem saber si s'ha processat el formulari
        if (isPost()) {


            $data["title"] = clean($_POST["title"]);
            $data["overview"] = clean($_POST["overview"]);
            $data["release_date"] = $_POST["release_date"];

            try {
                $uploadedFileHandler = new UploadedFileHandler("poster", $validTypes, self::MAX_SIZE);
                $data["poster"] = $uploadedFileHandler->handle(Movie::POSTER_PATH);
            }
            catch (NoUploadedFileException $e) {
                // la capture i no faig res perquè és una opció vàlida.
            }

            catch (FileUploadException $e) {
                $errors[] = $e->getMessage();
            }

            try {
                $movie = Movie::fromArray($data);
            }
            catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        if (isPost() && empty($errors)) {
            $movieRepository->save($movie);
            $message = "S'ha actualitzat el registre amb l'ID ({$data["id"]})";
        }
        require __DIR__ . "/../../views/movies-edit.view.php";
    }
}