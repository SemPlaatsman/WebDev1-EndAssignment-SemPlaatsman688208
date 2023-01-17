<?php
require __DIR__ . '/controller.php';

class HomeController extends Controller {
    private $homeService;

    function __construct() {
        
    }

    public function index() {
        $this->displayView();
    }
}
?>