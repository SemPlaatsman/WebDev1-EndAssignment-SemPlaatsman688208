<?php
class BookReservation {
    private int $id;
    private string $bookId;
    private string $bookThumbnail;
    private string $bookTitle;
    private int $userId;
    private DateTime $lendingDate;
    // used int because enums are part of PHP 8.1 and 000webhost doesn't support higher than 8.0
    private int $bookStatus;

    function __construct(int $id, string $bookId, string $bookThumbnail, string $bookTitle, int $userId, string $lendingDate, int $bookStatus) {
        $this->id = $id;
        $this->bookId = $bookId;
        $this->bookThumbnail = $bookThumbnail;
        $this->bookTitle = $bookTitle;
        $this->userId = $userId;
        $this->lendingDate = DateTime::createFromFormat('Y-m-d', $lendingDate);
        $this->bookStatus = $bookStatus;
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

    /**
     * Method for printing the book status since enums aren't supported
     */
    public function printBookStatus() {
        switch ($this->bookStatus) {
            case 0:
                return 'To be reserved, we\'re working hard to find it! <i class="fa-solid fa-magnifying-glass d-none d-sm-none d-md-inline"></i>';
            case 1:
                return 'Reserved and ready to be picked up! <i class="fa-solid fa-book d-none d-sm-none d-md-inline"></i>';
            case 2:
                return 'Lend out, enjoy your book! <i class="fa-regular fa-face-smile d-none d-sm-none d-md-inline"></i>';
            default:
                return '';
        }
    }
}

?>