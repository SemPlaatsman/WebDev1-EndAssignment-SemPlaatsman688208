<?php
require_once __DIR__ . '/bookstatus.php';
class BookReservation {
    private int $id;
    private string $bookId;
    private string $bookThumbnail;
    private string $bookTitle;
    private int $userId;
    private DateTime $lendingDate;
    private BookStatus $bookStatus;

    function __construct(int $id, string $bookId, string $bookThumbnail, string $bookTitle, int $userId, string $lendingDate, int $bookStatus) {
        $this->id = $id;
        $this->bookId = $bookId;
        $this->bookThumbnail = $bookThumbnail;
        $this->bookTitle = $bookTitle;
        $this->userId = $userId;
        $this->lendingDate = DateTime::createFromFormat('Y-m-d', $lendingDate);
        $this->bookStatus = BookStatus::intToEnum($bookStatus);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of bookId
     */ 
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * Get the value of bookThumbnail
     */ 
    public function getBookThumbnail()
    {
        return $this->bookThumbnail;
    }

    /**
     * Get the value of bookTitle
     */ 
    public function getBookTitle()
    {
        return $this->bookTitle;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of lendingDate
     */ 
    public function getLendingDate()
    {
        return $this->lendingDate;
    }

    /**
     * Get the value of bookStatus
     */ 
    public function getBookStatus()
    {
        return $this->bookStatus;
    }
}

?>