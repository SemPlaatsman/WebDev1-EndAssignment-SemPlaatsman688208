<?php 
class User {
    private int $id;
    private string $username;
    private bool $isAdmin = false;

    function __construct(int $id = null, string $username = null, bool $isAdmin = null) {
        if ($id != null) { $this->id = $id; }
        if ($username != null) { $this->username = $username; }
        if ($isAdmin != null) { $this->isAdmin = $isAdmin; }
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the value of isAdmin
     *
     * @return bool
     */
    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }
}
?>