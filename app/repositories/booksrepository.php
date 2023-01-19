<?php
require_once __DIR__ . '/repository.php';

class BooksRepository extends Repository {
    /**
     * Method to reserve a book in the database
     * Returns a boolean to check if the reservation was successfully created
     * 
     * @param string $bookId
     * @param string $smallThumbnail
     * @param string $title
     * @param int $userId
     * 
     * @return bool
     */
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