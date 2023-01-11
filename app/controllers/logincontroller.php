<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/loginservice.php';

class LoginController extends Controller {
    private $loginService;

    function __construct() {
        $this->loginService = new LoginService();
    }

    public function index() {
        $this->displayView();
    }

    public function validateUser(string $username, string $password) : ?User {
        return $this->loginService->validateUser($username, $password);
    }
}
?>