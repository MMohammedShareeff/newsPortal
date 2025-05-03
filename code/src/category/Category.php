<?php

namespace App\category;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\ENTITY
 * @ORM\Table(name="category")
 */
class Category {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;

     /** @ORM\Column(type="string") */
    private $description;

    public function __construct ( 
        $name, $description
    ){
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }
}