<?php

namespace App\category;

class Category {

    private $id;

    private $name;

    private $description;

    public function __construct ( 
        $name, $description
    ){
        $this->name = $name;
        $this->description = $description;
    }

}