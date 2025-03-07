<?php

include "map.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isbn = $_POST["isbn"] ?? 0;
    $firstName = $_POST["firstName"] ?? "";
    $lastName = $_POST["lastName"] ?? "";
    $bookName = $_POST["bookName"] ?? "";
    $description = $_POST["description"] ?? "";
    $img = $_POST["img"] ?? "";

    $repo = new BookRepository();
    $book = new Book($isbn, $firstName, $lastName, $bookName, $description, $img);
    $repo->createBook($book);
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridej Knihu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Kniha</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Seznam knih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="add.php">Přidej knihu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Vyhledej knihu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="display-5">Přidej knihu</h1>
        <form action="add.php" method="post">
            <div class="mb-2">
                <label class="form-label" for="isbn">ISBN</label>
                <input class="form-control" type="text" name="isbn" id="isbn" value="" require>
            </div>
            <div class="mb-2">
                <label class="form-label" for="firstName">Jméno Autora</label>
                <input class="form-control" type="text" name="firstName" id="firstName" value="" require>
            </div>
            <div class="mb-2">
                <label class="form-label" for="lastName">Příjmení Autora</label>
                <input class="form-control" type="text" name="lastName" id="lastName" value="" require>
            </div>
            <div class="mb-2">
                <label class="form-label" for="bookName">Název knihy</label>
                <input class="form-control" type="text" name="bookName" id="bookName" value="" require>
            </div>
            <div class="mb-2">
                <label class="form-label" for="description">Popis</label>
                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Vložte popis knihy" require></textarea>
            </div>
            <div class="mb-2">
                <label class="form-label" for="img">Obrázek</label>
                <input class="form-control" type="text" name="img" id="img" value="" require>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-secondary btn-sm">Ulozit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNdescriptionXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>