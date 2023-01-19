<?php
require_once __DIR__ . '/repository.php';

class LoginRepository extends Repository {
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
        $query = $this->connection->prepare("SELECT id, username, hashedPassword, isAdmin FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC)[0] ?? null;
        if (!empty($result) && (isset($result['id']) && isset($result['username']) && isset($result['isAdmin'])) && password_verify($_POST['password'], $result['hashedPassword'])) {
            return new User($result['id'], $result['username'], $result['isAdmin']);
        }
        return null;
    }
}
?>