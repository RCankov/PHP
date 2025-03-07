<?php
include "map.php";

// Initialize repository and variables
$repo = new BookRepository();
$books = [];
$error = '';

// Check if the form was submitted and at least one criterion is entered
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    // Trim and check if all fields are empty
    $isbn = trim($_GET['isbn'] ?? '');
    $firstName = trim($_GET['firstName'] ?? '');
    $lastName = trim($_GET['lastName'] ?? '');
    $bookName = trim($_GET['bookName'] ?? '');

    if (empty($isbn) && empty($firstName) && empty($lastName) && empty($bookName)) {
        $error = 'Prosím, zadejte alespoň jedno vyhledávací kritérium.';
    } else {
        // Call `filterBooks` only if at least one search criterion is provided
        $books = $repo->filterBooks($isbn, $firstName, $lastName, $bookName);

        // Check if no results were found
        if (empty($books)) {
            $error = 'Žádné výsledky nebyly nalezeny.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vyhledávání knih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Kniha</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Seznam knih</a></li>
                    <li class="nav-item"><a class="nav-link" href="add.php">Přidej knihu</a></li>
                    <li class="nav-item"><a class="nav-link active" href="search.php">Vyhledat knihu</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Form -->
    <div class="container mt-4">
        <h2>Vyhledávání knih</h2>
        <form action="search.php" method="get" class="p-4 rounded shadow bg-light">
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input class="form-control" type="text" name="isbn" id="isbn">
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">Jméno autora</label>
                <input class="form-control" type="text" name="firstName" id="firstName">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Příjmení autora</label>
                <input class="form-control" type="text" name="lastName" id="lastName">
            </div>
            <div class="mb-3">
                <label for="bookName" class="form-label">Název knihy</label>
                <input class="form-control" type="text" name="bookName" id="bookName">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg">Vyhledat</button>
            </div>
        </form>


        <!-- Error Message -->
        <?php if (!empty($error)): ?>
            <p class="text-danger mt-3"><?= $error ?></p>
        <?php endif; ?>

        <!-- Results -->
        <?php if (!empty($books)): ?>
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>ISBN</th>
                            <th>Jméno autora</th>
                            <th>Příjmení autora</th>
                            <th>Název knihy</th>
                            <th>Popis</th>
                            <th>Obrázek</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['isbn']) ?></td>
                                <td><?= htmlspecialchars($book['firstName']) ?></td>
                                <td><?= htmlspecialchars($book['lastName']) ?></td>
                                <td><?= htmlspecialchars($book['bookName']) ?></td>
                                <td><?php echo htmlspecialchars($book['description']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($book['img']); ?>" alt="Obrázek obalu" style="max-width: 100px; max-height: 100px;"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>