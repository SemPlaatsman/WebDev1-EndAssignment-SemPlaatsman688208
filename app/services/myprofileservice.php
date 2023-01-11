<?php
require __DIR__ . '/../repositories/myprofilerepository.php';

class MyProfileService {
    private $myProfileRepository;

    function __construct() {
        $this->myProfileRepository = new MyProfileRepository();
    }
}
?>