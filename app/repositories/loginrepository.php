<?php
require __DIR__ . '/repository.php';

class LoginRepository extends Repository {
    public function validateUser(string $username, string $password) : ?User {
        $query = $this->connection->prepare("SELECT id, username, hashedPassword, isAdmin FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        if (!empty($result) && password_verify($_POST['password'], $result['hashedPassword'])) {
            return new User($result['id'], $result['username'], $result['isAdmin']);
        }
        return null;
    }
}
?>