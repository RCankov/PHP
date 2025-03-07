<?php

class Book
{

    public $id;
    public $isbn;
    public $firstName;
    public $lastName;
    public $bookName;
    public $description;
    public $img;

    public function __construct($isbn, $firstName, $lastName, $bookName, $description, $img, $id = -1)
    {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bookName = $bookName;
        $this->description = $description;
        $this->img = $img;
    }
}
