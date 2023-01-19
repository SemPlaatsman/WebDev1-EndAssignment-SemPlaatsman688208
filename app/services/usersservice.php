<?php
require_once __DIR__ . '/../repositories/usersrepository.php';

class UsersService {
    private $usersRepository;

    function __construct() {
        $this->usersRepository = new UsersRepository();
    }

    /**
     * Method to get all users
     * Returns an array with all users
     * 
     * @return array
     */
    public function getAll() : array {
        $users = $this->usersRepository->getAll();
        return $users;
    }

    /**
     * Method to delete a user
     * 
     * @param int $userId
     */
    public function deleteUser(int $id) {
        $this->usersRepository->deleteUser($id);
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
    public function addUser(string $username, string $password, bool $isAdmin) : bool {
        return $this->usersRepository->addUser($username, $password, $isAdmin);
    }
}
?>