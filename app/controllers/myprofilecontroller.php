<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../models/book.php';
require_once __DIR__ . '/../models/bookstatus.php';
require_once __DIR__ . '/../services/myprofileservice.php';

class MyProfileController extends Controller {
    private $myProfileService;

    function __construct() {
        $this->myProfileService = new MyProfileService();
    }

    public function getUserBooks(int $userId) : array {
        return $this->myProfileService->getUserBooks($userId);
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }

        $user = unserialize($_SESSION['user']);
        $userBooks = $this->getUserBooks($user->getId());
        $this->displayView($userBooks);
    }
}
?>