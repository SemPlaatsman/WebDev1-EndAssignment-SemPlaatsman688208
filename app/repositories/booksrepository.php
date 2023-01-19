<?php
require_once __DIR__ . '/repository.php';

class BooksRepository extends Repository {
    public function reserveBook(string $bookId, string $smallThumbnail, string $title, int $userId) : bool {
        $query = $this->connection->prepare("INSERT INTO bookReservations (bookId, bookThumbnail, bookTitle, userId) VALUES (:bookId, :bookThumbnail, :bookTitle, :userId)");
        $query->bindParam(":bookId", $bookId);
        $query->bindParam(":bookThumbnail", $smallThumbnail);
        $query->bindParam(":bookTitle", $title);
        $query->bindParam(":userId", $userId);
        $query->execute();
        return boolval($query->rowCount());
    }
}
?>