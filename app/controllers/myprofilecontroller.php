<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/myprofileservice.php';

class MyProfileController extends Controller {
    private $myProfileService;

    function __construct() {
        $this->myProfileService = new MyProfileService();
    }

    public function index() {
        $this->displayView();
    }
}
?>