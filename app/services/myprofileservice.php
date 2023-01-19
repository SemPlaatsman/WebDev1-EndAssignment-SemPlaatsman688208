<?php
require_once __DIR__ . '/../repositories/myprofilerepository.php';

class MyProfileService {
    private $myProfileRepository;

    function __construct() {
        $this->myProfileRepository = new MyProfileRepository();
    }

    function getUserBooks(int $userId) : array {
        return $this->myProfileRepository->getUserBooks($userId);
    }
}
?>