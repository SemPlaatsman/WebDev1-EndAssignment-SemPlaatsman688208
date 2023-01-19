<?php
require_once __DIR__ . '/../repositories/myprofilerepository.php';

class MyProfileService {
    private $myProfileRepository;

    function __construct() {
        $this->myProfileRepository = new MyProfileRepository();
    }

    /**
     * Method to get the books of a user
     * Returns an array with user books
     * 
     * @param int $userId
     * 
     * @return array
     */
    function getUserBooks(int $userId) : array {
        return $this->myProfileRepository->getUserBooks($userId);
    }
}
?>