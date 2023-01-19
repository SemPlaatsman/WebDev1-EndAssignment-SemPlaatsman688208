<?php
require __DIR__ . '/repository.php';
//require __DIR__ . '/../models/user.php';
require_once('../models/user.php');

class UsersRepository extends Repository {
    function getAll() {
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

    // function getAllAdmins() {
    //     try {
    //         $stmt = $this->connection->prepare("SELECT id, username, isAdmin FROM users WHERE isAdmin=true");
    //         $stmt->execute();

    //         $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    //         $admins = $stmt->fetchAll();

    //         return $admins;
    //     } catch (PDOException $e) {
    //         echo $e;
    //     }
    // }

    // function getAllMembers() {
    //     try {
    //         $stmt = $this->connection->prepare("SELECT id, username, isAdmin FROM users WHERE isAdmin=false");
    //         $stmt->execute();

    //         $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    //         $members = $stmt->fetchAll();

    //         return $members;
    //     } catch (PDOException $e) {
    //         echo $e;
    //     }
    // }

    function deleteUser(int $id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM users WHERE id=:id LIMIT 1");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }

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