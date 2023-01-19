<?php
require_once __DIR__ . '/../repositories/loginrepository.php';

class LoginService {
    private $loginRepository;

    function __construct() {
        $this->loginRepository = new LoginRepository();
    }

    /**
     * Method to validate a user
     * Returns a ?User to check if the user was validated
     * If it returns null the user is invalid
     * If it returns a User the user is validated and can be used in the SESSION data
     * 
     * @param string $username
     * @param string $password
     * 
     * @return ?User
     */
    public function validateUser(string $username, string $password) : ?User {
        return $this->loginRepository->validateUser($username, $password);
    }
}
?>