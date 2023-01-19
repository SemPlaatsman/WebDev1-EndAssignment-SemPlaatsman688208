<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/usersservice.php';

class UsersController extends Controller {
    private $usersService;

    function __construct() {
        $this->usersService = new UsersService();
    }

    public function index() {
        $model = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
            if (!empty($_POST['id']) && isset($_POST['id'])) {
                $this->deleteUser(intval($_POST['id']));
            }
            else if (!empty($_POST['username']) && isset($_POST['username']) && !empty($_POST['password']) && isset($_POST['password'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $result = $this->addUser($username, $hashedPassword, false);
                $model += ['successPOST' => $result];
                // if () {
                //     $btnClass = "btn-success";
                //     $btnText = "Successfully added member!";
                // } else {
                //     $btnClass = "btn-danger";
                //     $btnText = "Could not add member!";
                // }
            }
        }

        $model += ['users' => $this->getAll()];
        $this->displayView($model);
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