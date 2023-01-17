<?php
require __DIR__ . '/../repositories/booksrepository.php';

class BooksService {
    private $booksRepository;

    function __construct() {
        $this->booksRepository = new BooksRepository();
    }

    public function reserveBook(string $bookId, string $smallThumbnail, string $title, int $userId) : bool {
        return $this->booksRepository->reserveBook($bookId, $smallThumbnail, $title, $userId);
    }
}
?>