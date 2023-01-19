<?php
require_once __DIR__ . '/../repositories/booksrepository.php';

class BooksService {
    private $booksRepository;

    function __construct() {
        $this->booksRepository = new BooksRepository();
    }

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
        return $this->booksRepository->reserveBook($bookId, $smallThumbnail, $title, $userId);
    }
}
?>