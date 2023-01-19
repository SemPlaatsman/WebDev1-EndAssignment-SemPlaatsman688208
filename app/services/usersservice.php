<?php
require_once __DIR__ . '/../repositories/usersrepository.php';

class UsersService {
    private $usersRepository;

    function __construct() {
        $this->usersRepository = new UsersRepository();
    }

    public function getAll() {
        // retrieve users
        $users = $this->usersRepository->getAll();
        return $users;
    }

    public function deleteUser(int $id) {
        $this->usersRepository->deleteUser($id);
    }

    public function addUser(string $username, string $password, bool $isAdmin) : bool {
        return $this->usersRepository->addUser($username, $password, $isAdmin);
    }

    // public function getAllAdmins() {
    //     // retrieve admins
    //     $admins = $this->usersRepository->getAllAdmins();
    //     return $admins;
    // }

    // public function getAllMembers() {
    //     // retrieve members
    //     $members = $this->usersRepository->getAllMembers();
    //     return $members;
    // }
}
?>