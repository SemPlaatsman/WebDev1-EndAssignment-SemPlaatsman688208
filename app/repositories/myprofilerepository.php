<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/bookreservation.php';

class MyProfileRepository extends Repository {
    /**
     * Method to get the books of a user
     * Returns an array with user books
     * 
     * @param int $userId
     * 
     * @return array
     */
    public function getUserBooks(int $userId) : array {
        $query = $this->connection->prepare("SELECT id, bookId, bookThumbnail, bookTitle, userId, lendingDate, bookStatus " .
                                            "FROM bookReservations " .
                                            "WHERE userId = :userId;");
        $query->bindParam(":userId", $userId);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'BookReservation');

        // if rowMapper function is already loaded, don't load it again
        if (!function_exists('rowMapper')) {
            // rowMapper based on this stackoverflow post: https://stackoverflow.com/questions/12368035/pdo-fetch-class-pass-results-to-constructor-as-parameters
            function rowMapper($id, $bookId, $bookThumbnail, $bookTitle, $userId, $lendingDate, $bookStatus) {
                return new BookReservation($id, $bookId, $bookThumbnail, $bookTitle, $userId, $lendingDate, $bookStatus);
            }
        }
        $userBooks = $query->fetchAll(PDO::FETCH_FUNC, 'rowMapper');
        return $userBooks;
    }
}
?>