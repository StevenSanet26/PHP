<?php

declare(strict_types=1);

namespace App\Controller;

class MovieController{

    public function list(){
        echo "mostrant les pelicules";
    }


    public function edit(int $id){
        echo "editant la pelicula #{$id}";
    }
}