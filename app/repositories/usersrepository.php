<?php
require_once __DIR__ . '/repository.php';
//require_once __DIR__ . '/../models/user.php';
require_once('../models/user.php');

class UsersRepository extends Repository {
    /**
     * Method to get all users
     * Returns an array with all users
     * 
     * @return array
     */
    function getAll() : array {
        try {
            $stmt = $this->connection->prepare("SELECT id, username, isAdmin FROM users");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $users = $stmt->fetchAll();

            return $users;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    /**
     * Method to delete a user
     * 
     * @param int $userId
     */
    function deleteUser(int $id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM users WHERE id=:id LIMIT 1");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    /**
     * Method to add a user
     * Returns a bool to check if a user was successfully added or not
     * 
     * @param string $username
     * @param string $password
     * @param bool $isAdmin
     * 
     * @return bool
     */
    function addUser(string $username, string $password, bool $isAdmin) : bool {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users (username, hashedPassword, isAdmin) VALUES (:username, :password, :isAdmin)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $intBool = (int)$isAdmin;
            $stmt->bindParam(":isAdmin", $intBool);
            $stmt->execute();
            
            return boolval($stmt->rowCount());

        } catch (PDOException $e) { }
        return false;
    }
}
?>