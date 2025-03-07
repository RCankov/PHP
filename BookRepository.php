<?php

class BookRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllBooks()
    {
        $stmt = $this->pdo->query("SELECT * FROM book");
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row["isbn"], $row["firstName"], $row["lastName"], $row["bookName"], $row["description"], $row["img"], $row["id"]);
        }
        return $books;
    }

    public function createBook(Book $books)
    {
        $stmt = $this->pdo->prepare("INSERT INTO book (isbn, firstName, lastName, bookName, description, img) VALUES (?,?,?,?,?,?)");
        return $stmt->execute([$books->isbn, $books->firstName, $books->lastName, $books->bookName, $books->description, $books->img]);
    }

    public function filterBooks($isbn, $firstName, $lastName, $bookName)
    {
        $query = "SELECT * FROM book WHERE 1=1"; // Use the correct table name: `book`
        $params = [];

        // Add dynamic conditions to the query only if the variables are not null or empty
        if (!empty($isbn)) {
            $query .= " AND isbn = ?";
            $params[] = $isbn;
        }
        if (!empty($firstName)) {
            $query .= " AND firstName LIKE ?";
            $params[] = "%{$firstName}%";
        }
        if (!empty($lastName)) {
            $query .= " AND lastName LIKE ?";
            $params[] = "%{$lastName}%";
        }
        if (!empty($bookName)) {
            $query .= " AND bookName LIKE ?";
            $params[] = "%{$bookName}%";
        }

        // Prepare and execute the statement
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the results as an associative array
    }
}
