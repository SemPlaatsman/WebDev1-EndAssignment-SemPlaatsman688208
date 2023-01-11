<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/usersservice.php';

class UsersController extends Controller {
    private $usersService;

    function __construct() {
        $this->usersService = new UsersService();
    }

    public function index() {
        $users = $this->getAll();

        $this->displayView($users);
    }

    /**
     * @return array<User>
     */
    public function getAll() : array {
        return $this->usersService->getAll();
    }

    public function deleteUser(int $id) {
        $this->usersService->deleteUser($id);
    }

    public function addUser(string $username, string $password, bool $isAdmin) : bool {
        return $this->usersService->addUser($username, $password, $isAdmin);
    }
}
?>