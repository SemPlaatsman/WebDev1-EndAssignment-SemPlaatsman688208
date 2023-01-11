<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/dashboardservice.php';

class DashboardController extends Controller {
    private $dashboardService;

    function __construct() {
        $this->dashboardService = new DashboardService();
    }

    public function index() {
        $this->displayView();
    }
}
?>