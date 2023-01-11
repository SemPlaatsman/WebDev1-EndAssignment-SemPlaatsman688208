<?php
require __DIR__ . '/../repositories/loginrepository.php';

class LoginService {
    private $loginRepository;

    function __construct() {
        $this->loginRepository = new LoginRepository();
    }

    public function validateUser(string $username, string $password) : ?User {
        return $this->loginRepository->validateUser($username, $password);
    }
}
?>